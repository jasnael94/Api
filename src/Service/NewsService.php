<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class NewsService
{
    private string $apiKey;

    public function __construct(
        private HttpClientInterface $httpClient, 
        string $newsApiKey
    ) {
        $this->apiKey = $newsApiKey;
    }

    public function getTopHeadlines(string $country = 'us'): array
    {
        try {
            $response = $this->httpClient->request('GET', 'https://newsapi.org/v2/top-headlines', [
                'query' => [
                    'country' => $country,
                    'apiKey' => $this->apiKey
                ]
            ]);

            return $response->toArray()['articles'] ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }
}