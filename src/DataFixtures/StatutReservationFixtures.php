<?php

namespace App\DataFixtures;

use App\Entity\StatutReservation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatutReservationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $statuts = [
            "En attente de validation",
            "Validée",
            "Annulée"
        ];

        foreach ($statuts as $item) {
            $statut = new StatutReservation();

            $statut->setLibelle($item);

            $manager->persist($statut);
        }

        $manager->flush();
    }
}
