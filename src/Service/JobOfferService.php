<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class JobOfferService
{
    private $httpClient;
    private $apiKey;

    public function __construct(HttpClientInterface $httpClient , string $apiKey)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $apiKey;  // Récupérer la clé API depuis l'environnement
    }

    // Obtenir les offres d'emploi
    public function getJobOffers(string $searchQuery, int $page, int $perPage): array
    {
        $url = "https://api.francetravail.io/partenaire/offresdemploi?query={$searchQuery}&page={$page}&per_page={$perPage}";

        // Effectuer la requête avec la clé API dans l'en-tête Authorization
        $response = $this->httpClient->request('POST', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,  // Utilisation de la clé API
            ]
        ]);

        return $response->toArray();  // Retourner les résultats sous forme de tableau
    }
}
