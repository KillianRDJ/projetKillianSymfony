<?php

namespace App\Repository;

use App\Entity\SerieEpisode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SerieEpisode|null find($id, $lockMode = null, $lockVersion = null)
 * @method SerieEpisode|null findOneBy(array $criteria, array $orderBy = null)
 * @method SerieEpisode[]    findAll()
 * @method SerieEpisode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieEpisodeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SerieEpisode::class);
    }

    // /**
    //  * @return SerieEpisode[] Returns an array of SerieEpisode objects
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
    public function findOneBySomeField($value): ?SerieEpisode
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
