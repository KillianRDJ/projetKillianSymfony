<?php

namespace App\Controller\Admin;

use App\Entity\Acteur;
use App\Form\ActeurType;
use App\Repository\ActeurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/acteur")
 */
class AdminActeurController extends AbstractController
{
    /**
     * @Route("/", name="admin.acteur.index", methods={"GET"})
     * @param ActeurRepository $acteurRepository
     * @return Response
     */
    public function index(ActeurRepository $acteurRepository): Response
    {
        return $this->render('admin/acteur/index.html.twig', ['acteurs' => $acteurRepository->findAll()]);
    }

    /**
     * @Route("/new", name="admin.acteur.new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $acteur = new Acteur();
        $form = $this->createForm(ActeurType::class, $acteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($acteur);
            $entityManager->flush();

            return $this->redirectToRoute('admin.acteur.index');
        }

        return $this->render('admin/acteur/new.html.twig', [
            'acteur' => $acteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin.acteur.edit", methods={"GET","POST"})
     * @param Request $request
     * @param Acteur $acteur
     * @return Response
     */
    public function edit(Request $request, Acteur $acteur): Response
    {
        $form = $this->createForm(ActeurType::class, $acteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.acteur.index', ['id' => $acteur->getId()]);
        }

        return $this->render('admin/acteur/edit.html.twig', [
            'acteur' => $acteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.acteur.delete", methods={"DELETE"})
     * @param Request $request
     * @param Acteur $acteur
     * @return Response
     */
    public function delete(Request $request, Acteur $acteur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$acteur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($acteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin.acteur.index');
    }
}
