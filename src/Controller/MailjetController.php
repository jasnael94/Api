<?php

namespace App\Controller;

use App\Service\MailjetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MailjetController extends AbstractController
{
    private $mailjetService;

    public function __construct(MailjetService $mailjetService)
    {
        $this->mailjetService = $mailjetService;
    }

    #[Route('/send-email', name: 'send_email')]
    public function sendEmail(): Response
    {
        // Variables à insérer dans le template
        $variables = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'some_other_variable' => 'Value'
        ];

        // ID du template Mailjet
        $templateId = 6740222; // Remplacez par l'ID réel de votre template Mailjet

        // Envoi de l'email
        $emailSent = $this->mailjetService->sendEmailFromTemplate(
            'jasnael94@icloud.com', // Destinataire
            'Member1', // Nom du destinataire
            $templateId, // ID du template Mailjet
            $variables // Variables dynamiques à insérer
        );

        if ($emailSent) {
            return $this->json(['status' => 'Email sent successfully']);
        }

        return $this->json(['status' => 'Failed to send email']);
    }
}
