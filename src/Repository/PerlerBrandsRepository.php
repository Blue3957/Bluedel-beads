<?php

namespace App\Repository;

use App\Entity\PerlerBrands;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PerlerBrands|null find($id, $lockMode = null, $lockVersion = null)
 * @method PerlerBrands|null findOneBy(array $criteria, array $orderBy = null)
 * @method PerlerBrands[]    findAll()
 * @method PerlerBrands[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerlerBrandsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PerlerBrands::class);
    }

    // /**
    //  * @return PerlerBrands[] Returns an array of PerlerBrands objects
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

    public function findOneByName($value): ?PerlerBrands
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.name = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
