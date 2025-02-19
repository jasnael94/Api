<?php


namespace App\Service;

use Mailjet\Client;
use Mailjet\Resources;

class MailjetService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(
            $_ENV['MAILJET_API_KEY_PUBLIC'],
            $_ENV['MAILJET_API_KEY_PRIVATE'],
            true, // Test mode (set to false in production)
            ['version' => 'v3.1']
        );
    }

    public function sendEmailFromTemplate($toEmail, $toName, $templateId, $vars = [])
    {
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => 'jasnael94@gmail.com',
                        'Name' => 'Jason'
                    ],
                    'To' => [
                        [
                            'Email' => $toEmail,
                            'Name' => $toName
                        ]
                    ],
                    'TemplateID' => $templateId,
                    'TemplateLanguage' => true,
                    'Variables' => $vars // Variables pour remplacer dans le template
                ]
            ]
        ];

        $response = $this->client->post(Resources::$Email, ['body' => $body]);

        if ($response->success()) {
            return true; // Email envoyé avec succès
        }

        return false; // Échec de l'envoi
    }
}