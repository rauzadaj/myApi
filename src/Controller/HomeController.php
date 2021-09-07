<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class HomeController extends AbstractController
{
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        $response = $this->client->request(
            'GET',
                    'https://data.education.gouv.fr/api/v2/catalog/datasets/fr-en-annuaire-education/records?where=code_postal%3D%2231000%22&limit=100'
        );
        $json_decoded = json_decode($response->getContent(), true);
       foreach ($json_decoded['records'] as $record) {
            echo $record['record']['fields']['nom_etablissement'].'&nbsp;';
            echo $record['record']['fields']['code_postal'].'&nbsp;';
            echo $record['record']['fields']['libelle_nature']. "<br />";
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
