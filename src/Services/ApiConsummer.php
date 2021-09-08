<?php
namespace App\Services;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\HttpTransportException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiConsummer extends AbstractController
{
    const URL = "https://data.education.gouv.fr/api/v2/catalog/datasets/fr-en-annuaire-education/records?";

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param string|null $type
     * @param int|null $postal_code
     * @param int|null $limit
     * @param int|null $offset
     * @return \Symfony\Contracts\HttpClient\ResponseInterface|void
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getEtablishment(string $type = null, int $postal_code = null, int $limit = null, int $offset = null)
    {
        $url = self::URL;
        $params = "where=code_postal%3D$postal_code&where=$type%3D1&limit%3D$limit";
        try {
            return $this->httpClient->request('GET',SELF::URL.$params);
        } catch (HttpTransportException $e) {
            echo $e;
        }
    }
}