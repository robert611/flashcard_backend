<?php

declare(strict_types=1);

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Stripe\Collection;
use Stripe\Product;
use Stripe\Stripe;
use Stripe\Price;

class StripePriceController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        Stripe::setApiKey(config('cashier.secret'));

        try {
            /** @var Collection<Price> $prices */
            $prices = Price::all(['limit' => 100]);

            $formattedPrices = collect($prices->data)->map(function (Price $price) {
                $product = Product::retrieve($price->product);

                return [
                    'id' => $price->id,
                    'type' => $price->type,
                    'product' => [
                        'name' => $product->name,
                        'description' => $product->description,
                    ],
                    'unit_amount' => $price->unit_amount / 100,
                    'currency' => strtoupper($price->currency),
                    'recurring' => $price->recurring ? $price->recurring->interval : null,
                ];
            });

            return response()->json([
                'success' => true,
                'prices' => $formattedPrices,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
