<?php

namespace App\Repository;

use App\Entity\SerieSeasons;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SerieSeasons|null find($id, $lockMode = null, $lockVersion = null)
 * @method SerieSeasons|null findOneBy(array $criteria, array $orderBy = null)
 * @method SerieSeasons[]    findAll()
 * @method SerieSeasons[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieSeasonsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SerieSeasons::class);
    }

    // /**
    //  * @return SerieSeasons[] Returns an array of SerieSeasons objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SerieSeasons
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
