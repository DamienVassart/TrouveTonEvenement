<?php

namespace App\DataFixtures;

use App\Entity\Staff;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

class StaffFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
//        $staffAdmin = new Staff();
//
//        $staffAdmin->setUsername('admin');
//
//        $staffAdmin->setRoles(['ROLE_SUPER_ADMIN', 'ROLE_ADMIN', 'ROLE_USER']);
//
//        $passsword = $this->hasher->hashPassword($staffAdmin, 'password');
//        $staffAdmin->setPassword($passsword);
//
//        $staffAdmin->setEmail('mail@example.com');
//
//        $manager->persist($staffAdmin);

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 5; $i++) {
            $staffMember = new Staff();

            $staffMember->setUsername($faker->userName);

            $staffMember->setRoles(['ROLE_ADMIN', 'ROLE_USER']);

            $passsword = $this->hasher->hashPassword($staffMember, 'password');
            $staffMember->setPassword($passsword);

            $staffMember->setEmail($faker->email);

            $manager->persist($staffMember);
        }

        $manager->flush();
    }
}
