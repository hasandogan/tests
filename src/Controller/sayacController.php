<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class sayacController extends AbstractController
{
    /**
     * @Route("/",name="index")
     */
    public function index(){
        return $this->render('sayac.html.twig');
    }

}