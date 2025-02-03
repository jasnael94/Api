<?php
namespace App\Controller;

use App\Service\CountriesService;
use App\Service\NewsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    #[Route('/news', name: 'app_news')]
    public function index(
        CountriesService $countriesService,
        NewsService $newsService
    ): Response {
        $countries = $countriesService->getAllCountries();
        $news = $newsService->getTopHeadlines();
        
        return $this->render('news/index.html.twig', [
            'countries' => $countries,
            'news' => $news
        ]);
    }
}