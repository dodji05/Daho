<?php

namespace App\Repository;

use App\Entity\LieuxInterets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LieuxInterets|null find($id, $lockMode = null, $lockVersion = null)
 * @method LieuxInterets|null findOneBy(array $criteria, array $orderBy = null)
 * @method LieuxInterets[]    findAll()
 * @method LieuxInterets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LieuxInteretsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LieuxInterets::class);
    }

    // /**
    //  * @return LieuxInterets[] Returns an array of LieuxInterets objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LieuxInterets
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
