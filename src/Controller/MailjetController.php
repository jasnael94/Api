<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MailjetController extends AbstractController
{
    #[Route('/mailjet', name: 'app_mailjet')]
    public function index(): Response
    {
        return $this->render('mailjet/index.html.twig', [
            'controller_name' => 'MailjetController',
        ]);
    }
}
