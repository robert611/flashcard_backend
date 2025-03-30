<?php

declare(strict_types=1);

namespace App\Http\Controllers\Stripe;

use App\Events\Stripe\PaymentIntentSucceeded;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Stripe\Event;
use Stripe\Invoice;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Subscription;
use Stripe\Exception\UnexpectedValueException;

class StripeWebhookController extends Controller
{
    public function handleSuccessCheckout(Request $request): JsonResponse
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $event = Event::constructFrom($request->toArray());
        } catch (UnexpectedValueException $e) {
            Log::error('Stripe webhook error: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        switch ($event->type) {
            case 'checkout.session.completed':
                /** @var Session $session */
                $session = $event->data->object;
                Log::info('Checkout completed:', ['session_id' => $session->id]);
                break;

            case 'invoice.payment_succeeded':
                /** @var Invoice $invoice */
                $invoice = $event->data->object;
                Log::info('Subskrypcja opłacona:', ['invoice_id' => $invoice->id]);
                break;

            case 'customer.subscription.deleted':
                /** @var Subscription $subscription */
                $subscription = $event->data->object;
                Log::info('Subskrypcja anulowana:', ['subscription_id' => $subscription->id]);
                break;

            case 'payment_intent.succeeded':
                /** @var PaymentIntent $paymentIntent */
                $paymentIntent = $event->data->object;
                $userId = $paymentIntent->metadata->user_id;

                event(new PaymentIntentSucceeded($paymentIntent->id, $userId));

                Log::info('Subskrpcja wykupiona:', ['payment_intent_id' => $paymentIntent->id]);
                break;

            default:
                Log::info('Nieobsługiwane zdarzenie Stripe: ' . $event->type);
        }

        return response()->json(['status' => 'success']);
    }
}
