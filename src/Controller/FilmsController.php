<?php

namespace App\Controller;

use App\Repository\FilmsRepository;

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

    public function __construct(FilmsRepository $films)
    {
        $this->films = $films;
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
        dump($filmById);
        return $this->render('films/show.html.twig', [
            'controller_name' => 'FilmsController',
            'allFilms' => $filmById,
        ]);
    }
}
