<?php

namespace App\Controller;

use App\Entity\LinkAsset;
use App\Repository\FilmsRepository;

use App\Repository\LinkAssetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmsController extends AbstractController
{
    /**
     * FilmsController constructor.
     * @var $films
     */
    private $films;

    public function __construct(FilmsRepository $films, LinkAssetRepository $linkAsset)
    {
        $this->films = $films;
        $this->linkAsset = $linkAsset;

    }


    /**
     * @Route("/films", name="films.index")
     * @return Response
     */
    public function index(): Response
    {
        $allFilms = $this->films->findAll();
        return $this->render('films/index.html.twig', [
            'controller_name' => 'FilmsController',
            'allFilms' => $allFilms,
        ]);
    }


    /**
     * @Route("/films/{slug}-{id}", name="films.show", requirements={"slug":"[a-z0-9\-]*"})
     * @return Response
     */
    public function show($slug, $id): Response
    {
        $filmById = $this->films->find($id);
        $getAllPlayerById = $this->linkAsset->findByIdFilm($id);


        return $this->render('films/show.html.twig', [
            'controller_name' => 'FilmsController',
            'allFilms' => $filmById,
            'getAllPlayerById' => $getAllPlayerById,
        ]);
    }

    /**
     * @Route("/films/{slug}-{id}/{idLink}", name="linkfilms.show", requirements={"slug":"[a-z0-9\-]*"})
     * @return Response
     */
    public function showFilm($slug, $id, $idLink): Response
    {
        $filmById = $this->films->find($id);
        $getAllPlayerById = $this->linkAsset->findByIdFilm($id);
        $getPlayerById =  $this->linkAsset->findByIdFilm($idLink);

        return $this->render('films/show.html.twig', [
            'controller_name' => 'FilmsController',
            'allFilms' => $filmById,
            'getAllPlayerById' => $getAllPlayerById,
            'getPlayerById' => $getPlayerById[0],
        ]);
    }

    /**
     * @Route("/films/search/{val}", name="films.search")
     * @param $val
     * @return Response
     */
    public function searchByName($val){
        $filmByName = $this->films->getFilmByNameLike($val);
        return new Response(json_encode($filmByName), 200);
    }





}
