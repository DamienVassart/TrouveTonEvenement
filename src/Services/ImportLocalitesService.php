<?php

namespace App\Services;

use App\Entity\Localite;
use App\Repository\LocaliteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @Author Damien Vassart
 */
class ImportLocalitesService
{
    public function __construct(
        private LocaliteRepository $localiteRepository,
        private EntityManagerInterface $em
    )
    {

    }

    /**
     * @param SymfonyStyle $io
     * @return void
     * @throws \League\Csv\Exception
     * @throws \League\Csv\InvalidArgument
     * @throws \League\Csv\UnavailableStream
     */
    public function importLocalites(SymfonyStyle $io)
    {
        $io->title('Importing Cities');

        $reader = new ReadCsvService();

        $localites = $reader->readCsvFile("../imports/", "localites.csv");

        $io->progressStart(count($localites));

        foreach ($localites as $row) {
            $localite = $this->localiteRepository->findOneBy(['inseeCode' => $row['insee_code']]);

            if (!$localite) {
                $localite = new Localite();
            }

            $columns = array_keys($row);

            $crudService = new CrudService();
            $crudService->setProperties($localite, $columns, $row);

            $this->em->persist($localite);

            $io->progressAdvance();
        }

        $this->em->flush();

        $io->progressFinish();

        $io->success('Cities imported successfully');
    }
}