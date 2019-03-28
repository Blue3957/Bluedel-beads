<?php

namespace App\Repository;

use App\Entity\PatternImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PatternImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method PatternImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method PatternImage[]    findAll()
 * @method PatternImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatternImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PatternImage::class);
    }

    // /**
    //  * @return PatternImage[] Returns an array of PatternImage objects
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
    public function findOneBySomeField($value): ?PatternImage
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
