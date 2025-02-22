<?php

declare(strict_types=1);

use App\Http\Controllers\FlashcardController;
use Illuminate\Support\Facades\Route;

Route::get('/flashcards', [FlashcardController::class, 'index']);
Route::post('/flashcards', [FlashcardController::class, 'store']);
Route::get('/flashcards/{id}', [FlashcardController::class, 'show']);
Route::put('/flashcards/{id}', [FlashcardController::class, 'update']);
Route::delete('/flashcards/{id}', [FlashcardController::class, 'destroy']);

