<?php

namespace App\Repository;

use App\Entity\ImagesCircuits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImagesCircuits|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImagesCircuits|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImagesCircuits[]    findAll()
 * @method ImagesCircuits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImagesCircuitsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImagesCircuits::class);
    }

    // /**
    //  * @return ImagesCircuits[] Returns an array of ImagesCircuits objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImagesCircuits
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
