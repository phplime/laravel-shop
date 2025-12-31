<?php

namespace App\Listeners;

use App\Events\AdminMail;
use App\Mail\AdminMailList;
use App\Services\SettingsService;
use App\Services\SendGridMailService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAdminMail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AdminMail $event): array
    {
        $type = $event->type ?? '';
        $data = $event->data ?? [];
        if (!isset($data['email'])) {
            return ['error' => 'Email is not set'];
        }

        $mail_type = __settings('mail_type') ?? 'smtp';

        $mailable = new AdminMailList($data, $type);

        if ($mail_type == 'sendgrid') {
            $config = app(SettingsService::class)->smtp_config();

            if (!$config) {
                return ['error' => 'SMTP configuration is missing'];
            }

            $mailContent = $mailable->getMailData();
            $mailContent['email'] = $mailContent['mail_to'] ?? $data['email'];
            $result = app(SendGridMailService::class)->send($mailContent, $config->sendgrid_api_key ?? '');

            return is_array($result) ? $result : ['error' => 'Unknown error occurred while sending email'];
        }

        $mailer = app(SettingsService::class)
            ->mailConfig();


        try {
            Mail::mailer($mailer)
                ->to($data['email'])
                ->send($mailable);
            return ['success' => true];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
