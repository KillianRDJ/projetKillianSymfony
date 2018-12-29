<?php

namespace App\Controller;

use App\Repository\FilmsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @var FilmsRepository
     */
    private $films;

    public function __construct(FilmsRepository $films)
    {

        $this->films = $films;
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $allFilmsBlockbuster = $this->films->getFilmBlockbuster();
        $getFilmsRandom = $this->films->getFilmsRandom();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'allFilmsBlockbuster' => $allFilmsBlockbuster,
            'filmRandoms' => $getFilmsRandom,
        ]);
    }
}
