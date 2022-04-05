<?php

namespace App\Repository;

use App\Entity\ImagesLieuxInterets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImagesLieuxInterets|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImagesLieuxInterets|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImagesLieuxInterets[]    findAll()
 * @method ImagesLieuxInterets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImagesLieuxInteretsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImagesLieuxInterets::class);
    }

    // /**
    //  * @return ImagesLieuxInterets[] Returns an array of ImagesLieuxInterets objects
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
    public function findOneBySomeField($value): ?ImagesLieuxInterets
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
