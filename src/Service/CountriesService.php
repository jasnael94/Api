<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CountriesService
{
    public function __construct(private HttpClientInterface $httpClient) {}

    public function getAllCountries(): array
    {
        try {
            $response = $this->httpClient->request('GET', 'https://restcountries.com/v3.1/all');
            return $response->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }
}