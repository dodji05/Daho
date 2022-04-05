<?php

namespace App\Repository;

use App\Entity\CategorieLieuxInterets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategorieLieuxInterets|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieLieuxInterets|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieLieuxInterets[]    findAll()
 * @method CategorieLieuxInterets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieLieuxInteretsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieLieuxInterets::class);
    }

    // /**
    //  * @return CategorieLieuxInterets[] Returns an array of CategorieLieuxInterets objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategorieLieuxInterets
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
