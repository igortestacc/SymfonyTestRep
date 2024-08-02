<?php

namespace App\Repository;

use App\Entity\UserNew;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserNew>
 */
class UserNewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserNew::class);
    }

    //    /**
    //     * @return UserNew[] Returns an array of UserNew objects
    //     */

    public function findAllByUsername(string $name = null): array
    {
        $queryBuilder = $this->createQueryBuilder('usernew')
            ->orderBy('usernew.id', 'DESC');

        if ($name != null) {
            $queryBuilder->andWhere('usernew.username LIKE :name')
                ->setParameter('name', $name);
        }

        return $queryBuilder->getQuery()->getResult();
    }

    public function createOrderedByQueryBuilder(): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('usernew')
            ->orderBy('usernew.id', 'DESC');

        return $queryBuilder;
    }

    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?UserNew
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
