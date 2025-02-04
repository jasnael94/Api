<?php

namespace App\Controller;

use App\Service\JobOfferService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobOfferController extends AbstractController
{
    private $jobOfferService;

    public function __construct(JobOfferService $jobOfferService)
    {
        $this->jobOfferService = $jobOfferService;
    }

    #[Route('/jobs', name: 'app_job_offers', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $searchQuery = $request->query->get('query', '');
        $page = (int) $request->query->get('page', 1);
        $perPage = 10;

        // Appel du service pour récupérer les offres d'emploi
        $offers = $this->jobOfferService->getJobOffers($searchQuery, $page, $perPage);

        // Retourner la réponse avec les données dans le template
        return $this->render('job_offer/index.html.twig', [
            'offers' => $offers,
            'searchQuery' => $searchQuery,
            'currentPage' => $page,
            'perPage' => $perPage,
        ]);
    }
}
