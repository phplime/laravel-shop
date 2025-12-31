<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorMailList extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public int $shopId, public array $data) {}

    public function build()
    {
        $subject = $this->data['subject'] ?? 'Notification';
        $type = $this->data['type'] ?? null;

        $html = match ($type) {
            'welcome' => $this->welcomeTemplate($this->data),
            'password_reset' => $this->resetPasswordTemplate($this->data),
            'order_success' => $this->orderSuccessTemplate($this->data),
            default => $this->defaultTemplate($this->data),
        };

        return $this->subject($subject)
            ->html($html);
    }

    // 📨 Predefined templates (can use inline variables)
    protected function welcomeTemplate($data)
    {
        $name = $data['name'] ?? 'User';
        return "
            <h1>Hello, {$name}!</h1>
            <p>Thank you for joining <strong>MyApp</strong>. We’re excited to have you onboard!</p>
        ";
    }

    protected function resetPasswordTemplate($data)
    {
        $url = $data['reset_link'] ?? '#';
        return "
            <h1>Password Reset Requested</h1>
            <p>Click below to reset your password:</p>
            <a href='{$url}' style='background:#4CAF50;color:#fff;padding:10px 15px;border-radius:5px;text-decoration:none;'>Reset Password</a>
        ";
    }

    protected function orderSuccessTemplate($data)
    {
        $orderId = $data['order_id'] ?? 'N/A';
        return "
            <h1>Order #{$orderId} Confirmed!</h1>
            <p>Thank you for your purchase. We’re preparing your order for shipment.</p>
        ";
    }

    protected function defaultTemplate($data)
    {
        return "
            <h1>Hello!</h1>
            <p>This is a default notification email.</p>
        ";
    }
}
