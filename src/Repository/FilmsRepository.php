<?php

namespace App\Repository;

use App\Entity\Films;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Films|null find($id, $lockMode = null, $lockVersion = null)
 * @method Films|null findOneBy(array $criteria, array $orderBy = null)
 * @method Films[]    findAll()
 * @method Films[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Films::class);
    }

    /**
     * @param $value
     * @return Films[] Returns an array of Films objects
     */
    public function getFilmByNameLike($value){
        return $this->createQueryBuilder('l')
            ->andWhere('l.name LIKE :val')
            ->setParameter('val', "%{$value}%")
            ->getQuery()
            ->getArrayResult()
            ;
    }
    public function getFilmByIdJson($value){
        return $this->createQueryBuilder('l')
            ->andWhere('l.id = :val')
            ->setParameter('val', "$value")
            ->getQuery()
            ->getArrayResult()
            ;
    }
    public function getFilmBlockbuster(){
        return $this->createQueryBuilder('l')
            ->andWhere('l.blockbuster = :val')
            ->setParameter('val', "1")
            //->orderBy('RAND()')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult()
            ;
    }
    public function getFilmsRandom(){
        return $this->createQueryBuilder('l')
            //->orderBy('RAND()')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
            ;
    }


    // /**
    //  * @return Films[] Returns an array of Films objects
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
    public function findOneBySomeField($value): ?Films
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
