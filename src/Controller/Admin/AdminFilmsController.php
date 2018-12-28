<?php

namespace App\Controller\Admin;

use App\Entity\Films;
use App\Entity\LinkAsset;
use App\Form\FilmsType;
use App\Form\LinkAssetType;
use App\Repository\FilmsRepository;
use App\Repository\LinkAssetRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminFilmsController extends AbstractController {

    /**
     * @var FilmsRepository
     */
    private $filmsRepository;
    /**
     * @var ObjectManager
     */
    private $em;
    /**
     * @var LinkAssetRepository
     */
    private $linkAssetRepository;

    /**
     * AdminFilmsController constructor.
     * @param FilmsRepository $filmsRepository
     * @param ObjectManager $em
     * @param LinkAssetRepository $linkAssetRepository
     */
    public function __construct(FilmsRepository $filmsRepository, ObjectManager $em, LinkAssetRepository $linkAssetRepository)
    {
        $this->filmsRepository = $filmsRepository;
        $this->em = $em;
        $this->linkAssetRepository = $linkAssetRepository;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin/films", name="admin.films.index")
     */
    public function index(){
        $allfilms = $this->filmsRepository->findAll();
        return $this->render('admin/films/index.html.twig', compact('allfilms'));

    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin/films/add", name="admin.films.new")
     */
    public function new(Request $request){

        $newFilms = new Films();
        $linkAsset = new LinkAsset();
        $form = $this->createForm(FilmsType::class, $newFilms);
        $form2 = $this->createForm(LinkAssetType::class, $linkAsset);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($newFilms);
            $this->em->flush();
            $this->addFlash('success', 'Le film à bien été ajouter');
            return $this->redirectToRoute('admin.films.index');
        }

        return $this->render('admin/films/new.html.twig',[
            'newFilms' => $newFilms,
            'form' => $form->createView(),
            'form2'=> $form2->createView(),
        ]);

    }

    /**
     * @param Films $films
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin/films/edit/{id}", name="admin.films.edit")
     */
    public function edit(Films $films, Request $request, $id){

        $linkVideo = $this->linkAssetRepository->findByIdFilm($id);

        $form = $this->createForm(FilmsType::class, $films);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Le films à bien été editer');
            return $this->redirectToRoute('admin.films.index');
        }

        return $this->render('admin/films/edit.html.twig',[
            'films' => $films,
            'form' => $form->createView(),
            'linkvideo' => $linkVideo,
        ]);

    }

    /**
     * @param Films $films
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin/films/delete/{id}", name="admin.films.delete")
     */
    public function delete(Films $films){
        $this->em->remove($films);
        $this->em->flush();
        $this->addFlash('success', 'Le film à bien été supprimer');
        return $this->redirectToRoute('admin.films.index');

    }

    /**
     * @Route("/admin/films/search/{val}", name="admin.films.search")
     * @param $val
     * @return Response
     */
    public function searchByName($val){
        $filmByName = $this->filmsRepository->getFilmByNameLike($val);
        return new Response(json_encode($filmByName), 200);
    }

    /**
     * @Route("/admin/films/searchid/{id}", name="admin.films.searchbyid")
     * @param $id
     * @return Response
     */
    public function searchById($id){
        $filmById = $this->filmsRepository->getFilmByIdJson($id);
        return new Response(json_encode($filmById), 200);
    }


}