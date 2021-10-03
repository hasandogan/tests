<?php

namespace App\Controller;

use App\Entity\CustomeCounter;
use App\Entity\User;
use App\Repository\CustomeCounterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class profileController extends AbstractController
{
    /**
     * @Route("/profile",name="profile")
     */
    public function index(){
        $session = new Session();
        $entityManager = $this->getDoctrine()->getManager();
        $customCheck = $entityManager->getRepository(CustomeCounter::class)->findBy(['user' => $session->get('id')]);
        if ($session->get('email')){
            return $this->render('profile.html.twig',[
                'data' => $customCheck
            ]);
        }else{
            return $this->redirect("/");
        }
    }

    /**
     * @Route ("/{id}/{slug}",name="counter")
     */
    public function showCustomCounter (string $slug){
        $entityManager = $this->getDoctrine()->getManager();
        $customCheck = $entityManager->getRepository(CustomeCounter::class)->findOneBy(['url' => $slug]);
        if ($customCheck){
        $session = new Session();
        $custom = $entityManager->getRepository(CustomeCounter::class)->findOneBy(['user' => $session->get('id')]);
        return $this->render('customCounter.html.twig', [
            'data' => $custom,
        ]);
        }else{
         return   $this->redirect("/");
        }
    }

    /**
     * @Route ("/addCustomIndex",name="addCustomIndex")
     */
    public function addCustomCounterAction (){
        $session = new Session();
        $email = $session->get('email');
        if ($email){
            return $this->render('addCustom.html.twig');
        }else{
            return $this->redirect("/login");
        }
    }

    /**
     * @Route ("/addCustom",name="addCustom")
     */
    public function addCustomCounter (Request $request){
        $session = new Session();
        $email = $session->get('email');
        if ($email){
            $entityManager = $this->getDoctrine()->getManager();
            $dateTime = $request->get('dateTime');
            $url = uniqid();
            $custom = new CustomeCounter();
            $custom->setName($request->get('name'));
            $custom->setTextFirst($request->get('firstText'));
            $custom->setTextLast($request->get('lastText'));
            $custom->setDateTime(date("y-m-d h:i:s",$dateTime));
            $custom->setUrl($url);
            $entityManager->persist($custom);
            $entityManager->flush();

        }else{
            return $this->redirect("/login");
        }
    }

}