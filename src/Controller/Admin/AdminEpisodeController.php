<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\SerieEpisode;
use App\Entity\Serie;

/**
 * @Route("/admin/episode")
 */
class AdminEpisodeController extends AbstractController
{
    /**
     * @Route("/add", name="admin.episode.new", methods={"GET","POST"})
     * @param Request $request
     */
    public function new(Request $request){
        $serie = new Serie();
        $episode = new SerieEpisode();

    }
}
?>