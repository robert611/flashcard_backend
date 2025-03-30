<?php

declare(strict_types=1);

namespace App\Events\Stripe;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentIntentSucceeded
{
    use Dispatchable, SerializesModels;

    public string $paymentIntentId;
    public int $userId;

    public function __construct(string $paymentIntentId, int $userId)
    {
        $this->paymentIntentId = $paymentIntentId;
        $this->userId = $userId;
    }
}
