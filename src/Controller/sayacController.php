<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
class sayacController extends AbstractController
{

    /**
     * @Route("/",name="secim-sayaci")
     */
    public function secimSayaci(){
        return $this->render('sayac.html.twig');

    }
    /**
     * @Route ("/new-year","new-year")
     */
    public function newYear(){
        return $this->render('newYear.html.twig');
    }

    /**
     * @Route ("/school","school")
     */
    public function school(){
        return $this->render('school.html.twig');
    }

    /**
     * @Route ("/login","login")
     */
   public function login(){
       return $this->render('login.html.twig');

   }


    /**
     * @Route ("/register", name="login")
     */
    public function register()
    {
        return $this->render('register.html.twig');
    }

    /**
     * @Route ("/logout",name="logout")
     */
    public function logout (){
        $session = new Session();
        $session->clear('email');
        return $this->redirect("/");
    }




}