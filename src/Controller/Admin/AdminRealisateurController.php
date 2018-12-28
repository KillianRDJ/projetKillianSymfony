<?php

namespace App\Controller\Admin;

use App\Entity\Realisateur;
use App\Form\RealisateurType;
use App\Repository\RealisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/realisateur")
 */
class AdminRealisateurController extends AbstractController
{
    /**
     * @Route("/", name="admin.realisateur.index", methods={"GET"})
     */
    public function index(RealisateurRepository $realisateurRepository): Response
    {
        return $this->render('admin/realisateur/index.html.twig', ['realisateurs' => $realisateurRepository->findAll()]);
    }

    /**
     * @Route("/new", name="admin.realisateur.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $realisateur = new Realisateur();
        $form = $this->createForm(RealisateurType::class, $realisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($realisateur);
            $entityManager->flush();

            return $this->redirectToRoute('admin.realisateur.index');
        }

        return $this->render('admin/realisateur/new.html.twig', [
            'realisateur' => $realisateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin.realisateur.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Realisateur $realisateur): Response
    {
        $form = $this->createForm(RealisateurType::class, $realisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.realisateur.index', ['id' => $realisateur->getId()]);
        }

        return $this->render('admin/realisateur/edit.html.twig', [
            'realisateur' => $realisateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.realisateur.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Realisateur $realisateur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$realisateur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($realisateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin.realisateur.index');
    }
}
