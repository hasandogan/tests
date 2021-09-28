<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class sayacController extends AbstractController
{

    /**
     * @Route("/",name="secim-sayaci")
     */
    public function secimSayaci(){
        $url = "https://www.dolarbey.com";
        $linkData = file_get_contents($url);

      $dolar = $this->getDolar($linkData);
      $euro = $this->getEuro($linkData);
      $pound = $this->getPound($linkData);
        return $this->render('sayac.html.twig', [
            'dolar' => $dolar,
            'euro' => $euro,
            'pound' => $pound
        ]);
    }
    public function getDolar($linkData){
        $data = preg_match_all('@<div data-socket-key="USD" data-socket-type="C" data-socket-attr="s" class="text-xl font-semibold text-white">(.*?)</div>@si',$linkData,$response);
        $dolar = $response[1][0];
            return $dolar;
    }
    public function getEuro($linkData){
        $data = preg_match_all('@<div data-socket-key="EUR" data-socket-type="C" data-socket-attr="s" class="text-xl font-semibold text-white">(.*?)</div>@si',$linkData,$response);
        $euro = $response[1][0];
        return $euro;
    }
    public function getPound($linkData){
        $data = preg_match_all('@<div data-socket-key="GBP" data-socket-type="C" data-socket-attr="s" class="text-xl font-semibold text-white">(.*?)</div>@si',$linkData,$response);
        $euro = $response[1][0];
        return $euro;
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



}