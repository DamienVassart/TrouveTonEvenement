<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

/**
 * @author Damien Vassart
 */
class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
//        Create a first user
        $user = new User();

        $user->setEmail('mail@example.com');

        $password = $this->hasher->hashPassword($user, 'password');
        $user->setPassword($password);

        $user->setPrenom('Jean');
        $user->setNom('Dupont');

        $user->setTelephone('0605459878');

        $user->setOrganisateur(true);

        $manager->persist($user);

//        Create several random users
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $user = new User();

            $user->setEmail($faker->email);

            $password = $this->hasher->hashPassword($user, 'password');
            $user->setPassword($password);

            $user->setPrenom($faker->firstName);
            $user->setNom($faker->lastName);

            $user->setTelephone($faker->phoneNumber);

            $bool = rand(0, 2);

            if ($bool == 0) {
                $user->setOrganisateur(false);
            }
            else {
                $user->setOrganisateur(true);
            }

            $manager->persist($user);
        }

        $manager->flush();
    }
}
