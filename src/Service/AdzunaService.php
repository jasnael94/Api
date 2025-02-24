<?php


namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class AdzunaService
{
    private HttpClientInterface $client;
    private string $adzunaId;
    private string $adzunaKey;
    private string $baseUrl;

    public function __construct(
        HttpClientInterface $client,
        string $adzunaId,
        string $adzunaKey,
        string $baseUrl
    ) {
        $this->client = $client;
        $this->adzunaId = $adzunaId;
        $this->adzunaKey = $adzunaKey;
        $this->baseUrl = $baseUrl;
    }

    public function searchJobs(array $params = []): array
    {
        $url = sprintf(
            '%s/jobs/%s/search/1?app_id=%s&app_key=%s',
            $this->baseUrl,
            $params['country'] ?? 'fr',
            $this->adzunaId,
            $this->adzunaKey
        );

        $response = $this->client->request('GET', $url, [
            'query' => $params
        ]);

        return $response->toArray();
    }

    public function getJobDetails(string $country, string $jobId): array
    {
        $url = sprintf(
            '%s/jobs/%s/%s?app_id=%s&app_key=%s',
            $this->baseUrl,
            $country,
            $jobId,
            $this->adzunaId,
            $this->adzunaKey
        );

        $response = $this->client->request('GET', $url);

        return $response->toArray();
    }
}
