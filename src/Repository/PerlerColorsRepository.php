<?php

namespace App\Repository;

use App\Entity\PerlerColors;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PerlerColors|null find($id, $lockMode = null, $lockVersion = null)
 * @method PerlerColors|null findOneBy(array $criteria, array $orderBy = null)
 * @method PerlerColors[]    findAll()
 * @method PerlerColors[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerlerColorsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PerlerColors::class);
    }

    /**
    * @return PerlerColors[] Returns an array of PerlerColors objects
    */
    public function findByBrand($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.brand = :val')
            ->setParameter('val', $value)
            ->orderBy('p.hex', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAll()
    {
        return $this->createQueryBuilder('p')
                    ->orderBy('p.hex', 'ASC')
                    ->getQuery()
                    ->getResult()
                ;
    }

    /*
    public function findOneBySomeField($value): ?PerlerColors
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
