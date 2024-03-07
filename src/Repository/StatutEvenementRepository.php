<?php

namespace App\Repository;

use App\Entity\StatutEvenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StatutEvenement>
 *
 * @method StatutEvenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatutEvenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatutEvenement[]    findAll()
 * @method StatutEvenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatutEvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatutEvenement::class);
    }

    //    /**
    //     * @return StatutEvenement[] Returns an array of StatutEvenement objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?StatutEvenement
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
