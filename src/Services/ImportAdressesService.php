<?php

namespace App\Services;

use App\Entity\Adresse;
use App\Entity\ImportProgress;
use App\Repository\AdresseRepository;
use App\Repository\ImportProgressRepository;
use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Finder\Finder;
use Psr\Log\NullLogger;
use Symfony\Component\Console\Style\SymfonyStyle;

ini_set('memory_limit', '-1');

/**
 * @Author Damien Vassart
 */
class ImportAdressesService
{
    public function __construct(
        private EntityManagerInterface $em,
        private AdresseRepository $adresseRepository,
        private ImportProgressRepository $importProgressRepository
    )
    {
    }

    public function importAdresses(SymfonyStyle $io, bool $resetAndImport, bool $reset)
    {
        $io->title('Importation des adresses');

        $this->em->getConnection()->getConfiguration()->setMiddlewares([new Middleware(new NullLogger())]);

        $importProgressRepository = $this->importProgressRepository;

        if ($resetAndImport) {
            $io->info('Reinitialisation des tables adresse et import_progress; cela peut prendre un certain temps');

            $this->adresseRepository->resetTable();
            $this->importProgressRepository->resetTable();

            $io->info('Tables reinitialisees, demarrage de l\'importation');
        }

        if ($reset) {
            $io->info('Reinitialisation des tables adresse et import_progress; cela peut prendre un certain temps');

            $this->adresseRepository->resetTable();
            $this->importProgressRepository->resetTable();

            $io->info('Tables reinitialisees');
            die();
        }

        // List all csv files
        $finder = new Finder();
        $files = $finder->files()->in('imports/adresses')->depth(0)->sortByName();

        // Process the files
        // $f : "imports/adresses/adresses-xxx.csv
        foreach ($files as $f => $file) {
            $fileName = $file->getFilename();

            if ($file->getSize() === 0) {
                continue;
            }

            $reader = new ReadCsvService();
            $adresses = $reader->readCsvFile("../", $f, ";");

            $io->text("Traitement de " . $fileName);

            // Initialize progress bar
            $io->progressStart(count($adresses));

            // Process the csv file lines ($adresses is 1-indexed)
            foreach ($adresses as $r => $row) {
                $importId = $this->generateImportId($f, $r);
                $progress = $importProgressRepository->findOneBy(['importId' => $importId]);
                $offset = $progress ? $progress->getLastLineProcessed() : 0;

                if ($r <= $offset) {
                    continue;
                }

                $adresse = new Adresse();

                $columns = array_keys($row);

                $crudService = new CrudService();
                $crudService->setProperties($adresse, $columns, $row);

                $this->em->persist($adresse);

                if (!$progress) {
                    $progress = new ImportProgress();
                    $progress->setImportId($importId);
                }
                $progress->setLastLineProcessed($r);
                $this->em->persist($progress);

                // Increment progress bar
                $io->progressAdvance();
            }
            // Process the csv file lines END

            $this->em->flush();
            $this->em->clear();

            // End progress bar
            $io->progressFinish();
        }
        // Process the files END

        $this->importProgressRepository->resetTable();

        $io->success('Importation des adresses terminee');
    }

    /**
     * @param string $fileName
     * @param string $row
     * @return string
     */
    private function generateImportId(string $fileName, string $row): string
    {
        return md5($fileName . $row);
    }
}