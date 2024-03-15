<?php

namespace App\Services;

use App\Entity\Adresse;
use App\Entity\ImportProgress;
use App\Repository\AdresseRepository;
use App\Repository\ImportProgressRepository;
use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Exception;
use League\Csv\InvalidArgument;
use League\Csv\UnavailableStream;
use Symfony\Component\Filesystem\Filesystem;
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

    /**
     * @param SymfonyStyle $io
     * @param bool $resetAndImport
     * @param bool $reset
     * @return void
     * @throws \Doctrine\DBAL\Exception
     * @throws Exception
     * @throws InvalidArgument
     * @throws UnavailableStream
     */
    public function importAdresses(SymfonyStyle $io, bool $resetAndImport, bool $reset)
    {
        // Garbage collector
        gc_enable();

        $io->title('Importing Addresses');

        // Disable SQL logging
        $this->em->getConnection()->getConfiguration()->setMiddlewares([new Middleware(new NullLogger())]);

        $filesystem = new Filesystem();
        $filesystem->mkdir("imports/adresses/processed");

        $adresseRepository = $this->adresseRepository;
        $importProgressRepository = $this->importProgressRepository;

        if ($resetAndImport) {
            $io->info('Resetting `adresse` et `import_progress` tables; this may take a while');

            $adresseRepository->resetTable();
            $importProgressRepository->resetTable();

            $io->info('Tables reset, starting import');
        }

        if ($reset) {
            $io->info('Resetting `adresse` et `import_progress` tables; this may take a while');

            $adresseRepository->resetTable();
            $importProgressRepository->resetTable();

            $io->info('Tables reset');
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
                $filesystem->remove("imports/adresses/" . $fileName);
                continue;
            }

            $reader = new ReadCsvService();
            $adresses = $reader->readCsvFile("../", $f, ";");

            $io->text("Processing " . $fileName);

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

            // Moving the file to "processed" directory
            $io->text("Moving file " . $fileName . "\n");
            $filesystem->rename("imports/adresses/" . $fileName, "imports/adresses/processed/" . $fileName);
            $io->text("Going ahead with processing\n");

            // Free memory
            $adresses = null;
            $file = null;
            gc_collect_cycles();
        }
        // Process the files END

        // Reset of import_progress table
        $io->text("Resetting `import_progress` table\n");
        $importProgressRepository->resetTable();
        $io->text("Table reset\n");

        $io->success('Addresses imported successfully');
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