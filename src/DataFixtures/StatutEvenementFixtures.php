<?php

namespace App\DataFixtures;

use App\Entity\StatutEvenement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * @author Damien Vassart
 */
class StatutEvenementFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $statuts = [
            "En attente de validation",
            "Validé",
            "Refusé",
            "Annulé"
        ];

        foreach ($statuts as $item) {
            $statut = new StatutEvenement();

            $statut->setLibelle($item);

            $manager->persist($statut);
        }

        $manager->flush();
    }
}
