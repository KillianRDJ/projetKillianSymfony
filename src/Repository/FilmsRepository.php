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

    public function getFilmByFilter($acteur, $genre, $realisateur){
        if(!$acteur == NULL) {
            if (count($acteur) > 1) {
                $a = 1;
                $acteursql = 'fa.acteur_id in(';
                foreach ($acteur as $acteurs) {
                    if ($a == count($acteur)) {
                        $acteursql .= $acteurs;
                    } else {
                        $acteursql .= $acteurs . ',';
                    }
                    $a++;
                }
                $acteursql .= ')';
            } elseif (count($acteur) == 1) {
                foreach($acteur as $acteurs) {
                    $acteursql = 'fa.acteur_id =' . $acteurs;
                }
            }
        }else{
            $acteursql ='fa.acteur_id';
        }
        if(!$genre == NULL) {
            if (count($genre) > 1) {
                $g = 1;
                $genresql = 'fg.genre_id in(';
                foreach ($genre as $genres) {
                    if ($g == count($genre)) {
                        $genresql .= $genres;
                    } else {
                        $genresql .= $genres . ',';
                    }
                    $g++;
                }
                $genresql .= ')';
            } elseif (count($genre) == 1) {
                foreach($genre as $genres) {
                    $genresql = 'fg.genre_id =' . $genres;
                }
            }
        }else{
            $genresql ='fg.genre_id';
        }
        if(!$realisateur == NULL) {
            if (count($realisateur) > 1) {
                $r = 1;
                $realisateurssql = 'fr.realisateur_id in(';
                foreach ($realisateur as $realisateurs) {
                    if ($r == count($realisateur)) {
                        $realisateurssql .= $realisateurs;
                    } else {
                        $realisateurssql .= $realisateurs . ',';
                    }
                    $r++;
                }
                $realisateurssql .= ')';
            } elseif (count($realisateur) == 1) {
                foreach($realisateur as $realisateurs) {
                    $realisateurssql = 'fr.realisateur_id =' . $realisateurs;
                }
            }
        }else{
            $realisateurssql ='fr.realisateur_id';
        }

        $rawSql = 'select f.* from films f inner join films_acteur fa on fa.films_id = f.id inner join films_genre fg on fg.films_id = f.id inner join films_realisateur fr on fr.films_id = f.id where
        '.$acteursql.' and '.$realisateurssql.' and '.$genresql.'
        group by f.id';

        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute([]);

        return $stmt->fetchAll();
    }


    public function getFilmsByAsset($asset, $id){
        switch($asset){
            case 'genre':
                $v = 'WHERE fg.genre_id = '.$id;
            break;
            case 'real':
                $v = 'WHERE fr.realisateur_id = '.$id;
            break;
            case 'acteur':
                $v = 'WHERE fa.acteur_id = '.$id;
            break;
        }

        $rawSql = 'select f.* from films f inner join films_acteur fa on fa.films_id = f.id inner join films_genre fg on fg.films_id = f.id inner join films_realisateur fr on fr.films_id = f.id  '.$v.' group by f.id';

        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute([]);

        return $stmt->fetchAll();
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
