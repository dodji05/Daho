<?php

namespace App\Repository;

use App\Entity\PointsArrets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PointsArrets|null find($id, $lockMode = null, $lockVersion = null)
 * @method PointsArrets|null findOneBy(array $criteria, array $orderBy = null)
 * @method PointsArrets[]    findAll()
 * @method PointsArrets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PointsArretsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PointsArrets::class);
    }

    // /**
    //  * @return PointsArrets[] Returns an array of PointsArrets objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PointsArrets
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
