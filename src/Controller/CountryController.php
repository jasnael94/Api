<?php
namespace App\Controller;

use App\Service\CountriesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CountryController extends AbstractController
{
    #[Route('/countries', name: 'app_countries')]
    public function index(CountriesService $countriesService): Response
    {
        $countries = $countriesService->getAllCountries();
        
        return $this->render('country/index.html.twig', [
            'countries' => $countries
        ]);
    }
}