<?php

declare(strict_types=1);

namespace App\Listeners\Stripe;

use App\Events\Stripe\PaymentIntentSucceeded;
use App\Models\User;
use App\Mails\Stripe\PaymentIntentSuccessMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HandlePaymentIntentSucceeded implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(PaymentIntentSucceeded $event): void
    {
        Log::info('Obsługa eventu PaymentSucceeded', ['paymentIntentId' => $event->paymentIntentId]);

        $user = User::where('id', $event->userId)->first();

        Mail::to($user->email)->send(new PaymentIntentSuccessMail($user->name));
    }
}
