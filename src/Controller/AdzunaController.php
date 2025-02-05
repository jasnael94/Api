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
            $params = [
                'what' => $request->query->get('what'),
                'where' => $request->query->get('where'),
                'distance' => $request->query->get('distance', 10),
                'country' => 'fr'
            ];

            $results = $this->adzunaApi->searchJobs($params);

            return $this->render('adzuna/index.html.twig', [
                'jobs' => $results['results'] ?? [],
                'totalPages' => ceil(($results['count'] ?? 0) / 10),
                'currentPage' => $request->query->getInt('page', 1)
            ]);
        } catch (\Exception $e) {
            $this->addFlash('error', 'Une erreur est survenue: ' . $e->getMessage());
            return $this->render('adzuna/index.html.twig', [
                'jobs' => []
            ]);
        }
    }
}