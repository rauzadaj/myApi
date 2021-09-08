<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ApiConsummer;


class EstablishmentController extends AbstractController
{
    /**
     * @Route("/establishment/elementary", name="elementary")
     * @param Request $request
     * @param ApiConsummer $apiConsummer
     * @return Response
     */
    public function getElementary(Request $request, ApiConsummer $apiConsummer) : Response
    {
        $response = $apiConsummer->getEtablishment("ecole_elementaire",  31000, 10);
//        $json_decoded = json_decode($response->getContent(), true);
//        foreach ($json_decoded['records'] as $record) {
//            echo $record['record']['fields']['nom_etablissement'] . '&nbsp;';
//            echo $record['record']['fields']['code_postal'] . '&nbsp;';
//            echo $record['record']['fields']['libelle_nature'] . "<br />";
//        }
        return  $this->render('establishment/index.html.twig');
    }

    /**
     * @Route("/home/secondary", name="secondary")
     */
    public function getSecondary(): Response
    {
        return new Response('secondary');
    }

    /**
     * @Route("/home/university", name="university")
     */
    public function getUniversity(): Response
    {
        return new Response('university');
    }
}
