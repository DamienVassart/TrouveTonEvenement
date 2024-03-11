<?php

namespace App\Repository;

use App\Entity\ImportProgress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImportProgress>
 *
 * @method ImportProgress|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImportProgress|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImportProgress[]    findAll()
 * @method ImportProgress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImportProgressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImportProgress::class);
    }

    /**
     * @return void
     * @throws \Doctrine\DBAL\Exception
     */
    public function resetTable(): void
    {
        $cn = $this->getEntityManager()->getConnection();

        $deleteQuery = "DELETE FROM `import_progress`";

        $cn->executeQuery($deleteQuery);

        $resetAIQuery = "ALTER TABLE `import_progress` AUTO_INCREMENT = 1";

        $cn->executeQuery($resetAIQuery);

        $cn->close();
    }
}
