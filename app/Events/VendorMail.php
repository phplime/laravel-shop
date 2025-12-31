<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VendorMail
{
    use Dispatchable, SerializesModels;

    public array $data;
    public int $shopId;

    public function __construct(int $shopId, array $data)
    {
        $this->shopId = $shopId;
        $this->data = $data;
    }
}
