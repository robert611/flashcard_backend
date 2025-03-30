<?php

declare(strict_types=1);

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use App\Http\Requests\StripeCheckoutRequest;
use App\Models\User;
use App\Utils\FrontendUrlResource;
use Stripe\Exception\ApiErrorException;
use Stripe\Price;
use Stripe\Stripe;

class StripeCheckoutController extends Controller
{
    /**
     * @throws ApiErrorException
     */
    public function checkout(StripeCheckoutRequest $request): string
    {
        $stripePriceId = $request->getStripePriceId();

        $quantity = 1;

        /** @var User $user */
        $user = $request->user();

        $frontendHost = config('app.frontend_host');

        Stripe::setApiKey(config('services.stripe.secret'));

        $price = Price::retrieve($stripePriceId);
        $mode = $price->recurring ? 'subscription' : 'payment';

        return $user->checkout([$stripePriceId => $quantity], [
            'success_url' => $frontendHost . FrontendUrlResource::PAYMENT_CANCEL_URL,
            'cancel_url' => $frontendHost . FrontendUrlResource::PAYMENT_CANCEL_URL,
            'mode' => $mode,
        ])->toJson();
    }
}
