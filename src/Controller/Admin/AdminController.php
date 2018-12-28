<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController {



    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin", name="admin.index")
     */

    public function index(){
        return $this->render('admin/index.html.twig');
    }



}