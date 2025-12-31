<?php

namespace App\Listeners;

use App\Events\VendorMail;
use App\Mail\VendorMailList;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendVendorMail implements ShouldQueue
{
    public function handle(VendorMail $event): void
    {
        $data = $event->data;

        if (!isset($data['email'])) {
            return;
        }

        // 1️⃣ Apply shop-based mail config
        $mailer = app(ShopMailConfigService::class)
            ->apply($event->shopId);

        // 2️⃣ Send mail using that mailer
        Mail::mailer($mailer)
            ->to($data['email'])
            ->send(new VendorMailList($event->shopId, $data));
    }
}
