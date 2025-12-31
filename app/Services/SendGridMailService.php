<?php

namespace App\Services;

use SendGrid;
use SendGrid\Mail\Mail;

class SendGridMailService
{
    public function send($data, string $apiKey): array
    {

        $email = new Mail();
        $email->setFrom(__settings('smtp_mail'), __settings('app_name'));
        $email->setSubject($data['subject']);
        $email->addTo($data['email']);
        $email->addContent("text/html", $data['msg']);

        $sendgrid = new SendGrid($apiKey);
        try {
            $response = $sendgrid->send($email);
            if ($response->statusCode() >= 200 && $response->statusCode() < 300) {
                return ['success' => true, 'message' => 'Email sent successfully'];
            } else {
                return ['error' => $response->body()];
            }
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
