<?php

namespace App\Controller;

use App\Entity\Clients;
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

}
