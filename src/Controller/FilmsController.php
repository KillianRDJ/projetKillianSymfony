<?php

namespace App\Controller;

use App\Entity\LinkAsset;
use App\Form\FilmsIndexType;
use App\Form\FilmsType;
use App\Repository\FilmsRepository;

use App\Repository\GenreRepository;
use App\Repository\LinkAssetRepository;
use Cocur\Slugify\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class FilmsController extends AbstractController
{
    /**
     * FilmsController constructor.
     * @var $films
     */
    private $films;
    /**
     * @var GenreRepository
     */
    private $genre;

    public function __construct(FilmsRepository $films, LinkAssetRepository $linkAsset, GenreRepository $genre)
    {
        $this->films = $films;
        $this->linkAsset = $linkAsset;
        $this->genre = $genre;
    }


    /**
     * @Route("/films", name="films.index")
     * @return Response
     */
    public function index(): Response
    {

        $allFilms = $this->films->findAll();
        $form = $this->createForm(FilmsIndexType::class);

        return $this->render('films/index.html.twig', [
            'controller_name' => 'FilmsController',
            'allFilms' => $allFilms,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/films/{slug}-{id}", name="films.show", requirements={"slug":"[a-z0-9\-]*"})
     * @return Response
     */
    public function show($slug, $id): Response
    {
        $filmById = $this->films->find($id);
        $this->films->setViewFilmsPlus($filmById);
        $getAllPlayerById = $this->linkAsset->findByIdFilm($id);
        $getGenre = $filmById->getGenres()->getValues();
        $i = 1;
        $result = '';
        foreach($getGenre as $getGenres){
            if($i == count($getGenre)){
                $result .= $getGenres->getId();
            }else{
                $result .= $getGenres->getId().',';
            }
            $i++;
        }


        $getFilmsSimilaire = $this->films->getFilmsSimilaire($result);

        return $this->render('films/show.html.twig', [
            'getFilmsSimilaire' => $getFilmsSimilaire,
            'controller_name' => 'FilmsController',
            'allFilms' => $filmById,
            'getAllPlayerById' => $getAllPlayerById,
        ]);
    }

    /**
     * @Route("/films/genre/{slug}-{id}", name="films.showByGenre", requirements={"slug":"[a-z0-9\-]*"})
     * @return Response
     */
    public function showByGenre($slug, $id): Response
    {
        $asset = 'genre';
        $getFilms = $this->films->getFilmsByAsset($asset, $id);
        return $this->render('films/index.html.twig', [
            'getFilms' => $getFilms,
        ]);
    }

    /**
     * @Route("/films/acteur/{slug}-{id}", name="films.showByActeur", requirements={"slug":"[a-z0-9\-]*"})
     * @return Response
     */
    public function showByActeur($slug, $id): Response
    {
        $asset = 'acteur';
        $getFilms = $this->films->getFilmsByAsset($asset, $id);
        return $this->render('films/index.html.twig', [
            'getFilms' => $getFilms,
        ]);
    }

    /**
     * @Route("/films/realisateur/{slug}-{id}", name="films.showByRealisateur", requirements={"slug":"[a-z0-9\-]*"})
     * @return Response
     */
    public function showByRealisateur($slug, $id): Response
    {
        $asset = 'real';

        $getFilms = $this->films->getFilmsByAsset($asset, $id);
        return $this->render('films/index.html.twig', [
            'getFilms' => $getFilms,
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

    /**
     * @Route("/films/search2", name="films.search2")
     * @param Request $request
     * @return Response
     */
    public function searchByName2(Request $request){
        $val = $request->query->get('q');
        $filmByName = $this->films->getFilmByNameLike($val);
        return new Response(json_encode($filmByName), 200);
    }

    /**
     * @Route("/films/filter", name="films.filter", )
     * @param Request $request
     * @return Response
     */
    public function searchByFilter(Request $request){
        $acteur = $request->query->get('acteurs');
        $genre = $request->query->get('genre');
        $realisateur = $request->query->get('real');
        $slugify = new Slugify();
        $html = '';
        $getFilms = $this->films->getFilmByFilter($acteur, $genre, $realisateur);
        if(count($getFilms) > 0) {
            foreach ($getFilms as $getFilm) {
                $html .= '
                <div class="single-blog-post col-2">
                        <div class="post-thumb">
                            <a href="' . $slugify->slugify($getFilm["name"]) . '-' . $getFilm["id"] . '"><img src="' . $getFilm['url_pochette'] . '" alt="' . $getFilm['name'] . '"></a>
                        </div>
                        <div class="text-center margin-top-10">
                            <a href="' . $slugify->slugify($getFilm["name"]) . '-' . $getFilm["id"] . '" class="post-title">
                                <h6 class="no-margin-bottom">' . $getFilm['name'] . '</h6>
                            </a>
                        </div>
                    </div>
                ';

            }
        }else{
            $html = 'Pas de films';
        }
        
        $getFilms = array('success' => $html);

        return new Response(json_encode($getFilms), 200);
    }





}
