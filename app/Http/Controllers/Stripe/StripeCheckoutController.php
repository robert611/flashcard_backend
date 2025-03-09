<?php

declare(strict_types=1);

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StripeCheckoutController extends Controller
{
    public function checkout(Request $request): string
    {
        $stripePriceId = 'price_1R0j5aQOfti2wuM4wlmvnMsq';

        $quantity = 1;

        /** @var User $user */
        $user = $request->user();

        return $user->checkout([$stripePriceId => $quantity], [
            'success_url' => route('checkout-success'),
            'cancel_url' => route('checkout-cancel'),
        ])->toJson();
    }
}
