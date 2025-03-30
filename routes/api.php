<?php

declare(strict_types=1);

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\FlashcardController;
use App\Http\Controllers\Stripe\StripeCheckoutController;
use App\Http\Controllers\Stripe\StripePriceController;
use App\Http\Controllers\Stripe\StripeWebhookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');

Route::get('/flashcards', [FlashcardController::class, 'index']);
Route::post('/flashcards', [FlashcardController::class, 'store']);
Route::get('/flashcards/{id}', [FlashcardController::class, 'show']);
Route::put('/flashcards/{id}', [FlashcardController::class, 'update']);
Route::delete('/flashcards/{id}', [FlashcardController::class, 'destroy']);

Route::get('/classrooms', [ClassroomController::class, 'index']);

Route::get('/stripe/prices', [StripePriceController::class, 'index']);

Route::post('/stripe/checkout', [StripeCheckoutController::class, 'checkout'])->middleware('auth:sanctum');
Route::post('/stripe/checkout/success/webhook', [StripeWebhookController::class, 'handleSuccessCheckout']);
