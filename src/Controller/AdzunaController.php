<?php

namespace App\Controller;

use App\Service\AdzunaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdzunaController extends AbstractController
{
    private AdzunaService $adzunaApi;

    public function __construct(AdzunaService $adzunaApi)
    {
        $this->adzunaApi = $adzunaApi;
    }

    #[Route('/adzuna', name: 'app_adzuna')]
    public function index(Request $request): Response
    {
        try {
            $searchQuery = $request->query->get('what');
            $location = $request->query->get('where');
            $distance = $request->query->get('distance', 10); 
            $page = $request->query->getInt('page', 1); 
    
            $params = [
                'what' => $searchQuery,
                'where' => $location,
                'distance' => $distance,
                'country' => 'fr',
                'page' => $page,
            ];
    
            // Construction de l'URL pour l'API
            $url = sprintf(
                '%s/jobs/%s/search/%d?app_id=%s&app_key=%s&what=%s&where=%s&distance=%d&page=%d',
                $this->baseUrl,  // Assure-toi que $this->baseUrl est bien défini
                'fr', // pays
                $page,
                $this->adzunaId, // app_id
                $this->adzunaKey, // app_key
                urlencode($searchQuery),
                urlencode($location),
                $distance,
                $page
            );
    
            // Afficher l'URL pour débogage
            dump($url);
    
            // Appel à l'API
            $results = $this->adzunaApi->searchJobs($params);
            
            dump($results); // Affiche les résultats bruts
    
            $totalResults = $results['count'] ?? 0;
            $totalPages = ceil($totalResults / 10);
    
            return $this->render('adzuna/index.html.twig', [
                'jobs' => $results['results'] ?? [],
                'searchQuery' => $searchQuery,
                'location' => $location,
                'currentPage' => $page,
                'totalPages' => $totalPages,
                'totalResults' => $totalResults
            ]);
        } catch (\Exception $e) {
            $this->addFlash('error', 'Une erreur est survenue: ' . $e->getMessage());
            return $this->render('adzuna/index.html.twig', [
                'jobs' => [],
                'searchQuery' => $searchQuery ?? '',
                'location' => $location ?? '',
                'currentPage' => $page ?? 1,
                'totalPages' => 0,
                'totalResults' => 0
            ]);
        }
    }
    

}