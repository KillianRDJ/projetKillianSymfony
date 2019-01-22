<?php

namespace App\Controller\Admin;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/serie")
 */
class AdminSerieController extends AbstractController
{
    /**
     * @Route("/", name="admin.serie.index", methods={"GET"})
     */
    public function index(SerieRepository $serieRepository): Response
    {
        return $this->render('admin/serie/index.html.twig', [
            'series' => $serieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin.serie.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $serie = new Serie();
        $form = $this->createForm(SerieType::class, $serie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($serie);
            $entityManager->flush();

            return $this->redirectToRoute('admin.serie.index');
        }

        return $this->render('admin/serie/new.html.twig', [
            'serie' => $serie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="serie_show", methods={"GET"})
     */
    public function show(Serie $serie): Response
    {
        return $this->render('serie/show.html.twig', [
            'serie' => $serie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="serie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Serie $serie): Response
    {
        $form = $this->createForm(SerieType::class, $serie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.serie.index', [
                'id' => $serie->getId(),
            ]);
        }

        return $this->render('admin/serie/edit.html.twig', [
            'serie' => $serie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="serie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Serie $serie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$serie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($serie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin.serie.index');
    }
}
