<?php

namespace App\Repository;

use App\Entity\LinkAsset;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LinkAsset|null find($id, $lockMode = null, $lockVersion = null)
 * @method LinkAsset|null findOneBy(array $criteria, array $orderBy = null)
 * @method LinkAsset[]    findAll()
 * @method LinkAsset[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinkAssetRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LinkAsset::class);
    }

    /**
    * @return LinkAsset[] Returns an array of LinkAsset objects
    */
    public function findByIdFilm($id)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.idAsset = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getResult()
        ;
    }



    // /**
    //  * @return LinkAsset[] Returns an array of LinkAsset objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LinkAsset
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
