<?php

namespace App\Repository;

use App\Entity\Adresse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Adresse>
 *
 * @method Adresse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adresse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adresse[]    findAll()
 * @method Adresse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdresseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adresse::class);
    }

    /**
     * @return void
     * @throws \Doctrine\DBAL\Exception
     */
    public function resetTable(): void
    {
        $cn = $this->getEntityManager()->getConnection();

        $deleteQuery = "DELETE FROM `adresse`";

        $cn->executeQuery($deleteQuery);

        $resetAIQuery = "ALTER TABLE `adresse` AUTO_INCREMENT = 1";

        $cn->executeQuery($resetAIQuery);

        $cn->close();
    }
}
