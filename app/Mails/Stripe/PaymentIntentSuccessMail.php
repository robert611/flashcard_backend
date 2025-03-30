<?php

declare(strict_types=1);

namespace App\Mails\Stripe;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentIntentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $userName;

    public function __construct(string $userName)
    {
        $this->userName = $userName;
    }

    public function build(): self
    {
        return $this->subject('Subskrypcja aktywowana')
            ->markdown('mails.payment-success')
            ->with(['userName' => $this->userName]);
    }
}
