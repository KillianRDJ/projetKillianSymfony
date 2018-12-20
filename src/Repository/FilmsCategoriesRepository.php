<?php

namespace App\Repository;

use App\Entity\FilmsCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FilmsCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method FilmsCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method FilmsCategories[]    findAll()
 * @method FilmsCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmsCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FilmsCategories::class);
    }

    // /**
    //  * @return FilmsCategories[] Returns an array of FilmsCategories objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FilmsCategories
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
