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
        $customCheck = $entityManager->getRepository(CustomeCounter::class)->findBy(['user' => $session->get('id')],['id'=>'desc']);
        if ($session->get('id') != null){
            return $this->render('profile.html.twig',[
                'data' => $customCheck
            ]);
        }else{
            return $this->redirect("/");
        }
    }



    /**
     * @Route ("/addCustomIndex",name="addCustomIndex")
     */
    public function addCustomCounterAction (){
        $session = new Session();
        $id = $session->get('id');
        if ($id != null){
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
        $id = $session->get('id');
        if ($id != null){
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(user::class)->findOneBy(['id' => $id]);

            $entityManager = $this->getDoctrine()->getManager();
            $dateTime = $request->get('dateTime');
            $value = date("Y-m-d H:i:s", strtotime($dateTime));
            $url = uniqid();
            $custom = new CustomeCounter();
            $custom->setName($request->get('name'));
            $custom->setTextFirst($request->get('firsText'));
            $custom->setTextLast($request->get('lastText'));
            $custom->setDateTime($value);
            $custom->setUrl($url);
            $custom->setUser($user);
            $custom->setLikeCount(0);
            $entityManager->persist($custom);
            $entityManager->flush();
            return $this->redirect("/profile");
        }else{
            return $this->redirect("/login");
        }
    }

    /**
     * @Route ("/deleteCustom/{id}",name="delete")
     */
    public function deleteAction( $id){

        $entityManager = $this->getDoctrine()->getManager();
        $customCheck = $entityManager->getRepository(CustomeCounter::class)->findOneBy(['id' => $id]);
        $entityManager->remove($customCheck);
        $entityManager->flush();

        return $this->redirect("/profile");

    }
       /**
     * @Route ("/public/{slug}",name="counter")
     */
    public function showCustomCounter (string $slug){
        $entityManager = $this->getDoctrine()->getManager();
        $customCheck = $entityManager->getRepository(CustomeCounter::class)->findOneBy(['url' => $slug]);
        if ($customCheck == null ){
            var_export("dddd");

          return  $this->redirect('/404');
        }
        $session = new Session();
            return $this->render('customCounter.html.twig', [
                'data' => $customCheck,
            ]);
    }



}
