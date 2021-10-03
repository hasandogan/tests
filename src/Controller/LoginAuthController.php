<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
class LoginAuthController extends AbstractController
{
    /**
     * @Route ("/loginAuth")
     **/
    public function loginAuthCeheck(Request $request){

         $email =  $request->get('email');
        $password =$request->get('password');
        $entityManager = $this->getDoctrine()->getManager();
        $userRepo = $entityManager->getRepository(User::class)->findOneBy([
            'email' =>$email,
            'password' => $password
        ]);
    if ($userRepo){
        $session = new Session();
        $session->set('email', $email);
        $session->set('id', $userRepo->getId());
     return $this->redirect("/profile");
    }else{
    return  $this->redirect("/");
    }
    }

}