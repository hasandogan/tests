<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Entity\CustomeCounter;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route ("api/getAuth")
     * @param Request $request
     */
    public function getUserAtuh(Request $request) {

        $parameter = json_decode($request->getContent(),true);
        $passwords = sha1($parameter['password']);
        $email = $parameter['email'];

        $entityManager = $this->getDoctrine()->getManager();
        $userRepo = $entityManager->getRepository(User::class)->findOneBy([
            'email' => $email,
            'password' => $passwords
        ]);

            if ($userRepo != null){
                 $clientRepo = $entityManager->getRepository(Clients::class)->findOneBy([
                 'userId' => $userRepo->getId(),
            ]);
            if($clientRepo != null){
                 $clientArray = ['token' => $clientRepo->getToken(), 'user' => [
                'username' => $userRepo->getUserName(),
                'email' => $userRepo->getEmail(),
                'id' => $userRepo->getId(),
                'role' => $userRepo->getRole()
            ]];
            return  new Response(json_encode($clientArray));
            }
            $bytes = random_bytes(20);
            $token = bin2hex($bytes);
            $client = new Clients();
            $client->setToken($token);
            if ($userRepo->getRole() != null)
            {$client->setRole($userRepo->getRole());}
            $client->setUserId($userRepo->getId());
            $entityManager->persist($client);
            $entityManager->flush();
            $clientArray = ['token' => $client->getToken(), 'user' => [
                'username' => $userRepo->getUserName(),
                'email' => $userRepo->getEmail(),
                'id' => $userRepo->getId(),
                'role' => $userRepo->getRole()
            ]];
            return  new Response(json_encode($clientArray));
        }else{
            return new Response(json_encode(['error' => 'user not found']));
        }

    }

    /**
     * @Route ("api/getLogout")
     */
    public function logoutAuth(Request $request){
        $parameter = json_decode($request->getContent(),true);
        $token = $parameter['token'];
        $entityManager = $this->getDoctrine()->getManager();
        $tokenRepo = $entityManager->getRepository(Clients::class)->findOneBy(['token' => $token]);
        $entityManager->remove($tokenRepo);
        $entityManager->flush();
            return new Response('session end');

    }

    /**
     * @Route ("api/getCountDown")
     */
    public function countDown(Request $request){
        $parameter = json_decode($request->getContent(),true);
        $token = $parameter['token'];
        $entityManager = $this->getDoctrine()->getManager();
        $tokenRepo = $entityManager->getRepository(Clients::class)->findOneBy(['token' => $token]);
        $user = $entityManager->getRepository(User::class)->findOneBy(['id' => $tokenRepo->getUserId()]);
        $counter = $entityManager->getRepository(CustomeCounter::class)->findBy(['user' => $user]);
        $counterArray = [];
        foreach ($counter as $count ){
            $counterArray[] = ['id' => $count->getId(),'userId' => $count->getUser()->getId(),'name' => $count->getName(),'firstText' => $count->getTextFirst(),'lastText' => $count -> getTextLast(),'dateTime' => $count ->getDateTime()];
        }
        return new Response(json_encode($counterArray));
    }
     /**
     * @Route ("api/lastCounter")
     */
    public function indexData(){
        $entityManager = $this->getDoctrine()->getManager();
        $customCheck = $entityManager->getRepository(CustomeCounter::class)->findlastfivecustomeCounter();
         foreach ($customCheck as $count ){
            $counterArray[] = ['id' => $count->getId(),'userId' => $count->getUser()->getId(),'name' => $count->getName(),'firstText' => $count->getTextFirst(),'lastText' => $count -> getTextLast(),'dateTime' => $count ->getDateTime()];
        }
        dd($counterArray);exit;
        return new Response(json_encode($customCheck));
    }

}
