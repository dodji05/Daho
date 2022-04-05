<?php

namespace App\Repository;

use App\Entity\ImageVille;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImageVille|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageVille|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageVille[]    findAll()
 * @method ImageVille[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageVilleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageVille::class);
    }

    // /**
    //  * @return ImageVille[] Returns an array of ImageVille objects
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
    public function findOneBySomeField($value): ?ImageVille
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
