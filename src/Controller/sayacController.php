<?php

namespace App\Controller;

use App\Entity\CustomeCounter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
class sayacController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function index(){
        return $this->render('index.html.twig', ['data'=>$this->indexData()]);

    }

    /**
     * @Route ("/getIndexData",name="getIndexData")
     */
    public function indexData(){
        $entityManager = $this->getDoctrine()->getManager();
        $customCheck = $entityManager->getRepository(CustomeCounter::class)->findlastfivecustomeCounter();
        return $customCheck;
    }

    /**
     * @Route("/secim-sayaci",name="secim-sayaci")
     */
    public function secimSayaci(){
        return $this->render('sayac.html.twig');

    }
    /**
     * @Route ("/yil-basi-sayaci","new-year")
     */
    public function newYear(){
        return $this->render('newYear.html.twig');
    }

    /**
     * @Route ("/okul-sayaci","school")
     */
    public function school(){
        return $this->render('school.html.twig');
    }

    /**
     * @Route ("/giris","login")
     */
   public function login(){
       return $this->render('login.html.twig');

   }


    /**
     * @Route ("/kayitol", name="login")
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
