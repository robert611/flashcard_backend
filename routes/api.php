<?php

declare(strict_types=1);

use App\Http\Controllers\FlashcardController;
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
