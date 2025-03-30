<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StripeCheckoutRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'stripe_price_id' => 'required|string',
        ];
    }

    public function getStripePriceId(): string
    {
        return $this->input('stripe_price_id');
    }
}
