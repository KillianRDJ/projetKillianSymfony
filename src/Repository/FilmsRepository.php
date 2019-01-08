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
    public function getFilmsSimilaire($value){
        $rawSql = 'select * from films_genre a JOIN films f ON a.films_id = f.id where a.genre_id IN('.$value.') group by f.id order by RAND() LIMIT 6';

        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute([]);

        return $stmt->fetchAll();
    }
    public function setViewFilmsPlus($films){
        return $this
            ->createQueryBuilder('f')
            ->update($this->getEntityName(), 'f')
            ->set('f.nbrevues', $films->getNbrevues() + 1)
            ->where('f.id = :id')->setParameter('id', $films->getId())
            ->getQuery()
            ->execute();
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
