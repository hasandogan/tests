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
    public function loginAuthCeheck(Request $request)
    {

        $passwords = sha1($request->request->get('password'));
        $email = $request->get('email');
        $entityManager = $this->getDoctrine()->getManager();
        $userRepo = $entityManager->getRepository(User::class)->findOneBy([
            'email' => $email,
            'password' => $passwords
        ]);
        if ($userRepo) {
            $session = new Session();
            $session->set('email', $email);
            $session->set('id', $userRepo->getId());
            return $this->redirect("/profile");
        } else {
            return $this->redirect("/");
        }
    }

    /**
     * @Route ("/registerAuth")
     **/
    public function registerAuth(Request $request)
    {
        $password1 = sha1($request->request->get('password1'));
        $password2 = sha1($request->request->get('password2'));
        if ($password1 === $password2) {
            $user = new User ();
            $user->setEmail($request->request->get('email'));
            $user->setPassword($password1);
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirect("/login");

        } else {
            return $this->redirect("/register");
        }
    }

}