<?php

namespace App\Controller\Admin;

use App\Entity\LinkAsset;
use App\Form\LinkAsset1Type;
use App\Repository\LinkAssetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/linkvideofilms")
 */
class AdminLinkAssetController extends AbstractController
{
    /**
     * @Route("/", name="admin.linkvideo.index", methods={"GET"})
     */
    public function index(LinkAssetRepository $linkAssetRepository): Response
    {
        return $this->render('admin/link_asset/index.html.twig', ['link_assets' => $linkAssetRepository->findAll()]);
    }

    /**
     * @Route("/new", name="admin.linkvideo.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $linkAsset = new LinkAsset();
        $form = $this->createForm(LinkAsset1Type::class, $linkAsset);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($linkAsset);
            $entityManager->flush();

            return $this->redirectToRoute('admin.linkvideo.index');
        }

        return $this->render('admin/link_asset/new.html.twig', [
            'link_asset' => $linkAsset,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="admin.linkvideo.show", methods={"GET"})
     */
    public function show(LinkAsset $linkAsset): Response
    {
        return $this->render('admin/link_asset/show.html.twig', ['link_asset' => $linkAsset]);
    }

    /**
     * @Route("/{id}/edit", name="admin.linkvideo.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LinkAsset $linkAsset): Response
    {
        $form = $this->createForm(LinkAsset1Type::class, $linkAsset);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.linkvideo.index', ['id' => $linkAsset->getId()]);
        }

        return $this->render('admin/link_asset/edit.html.twig', [
            'link_asset' => $linkAsset,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.linkvideo.delete", methods={"DELETE"})
     */
    public function delete(Request $request, LinkAsset $linkAsset): Response
    {
        if ($this->isCsrfTokenValid('delete'.$linkAsset->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($linkAsset);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin.linkvideo.index');
    }
}
