<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreFlashcardRequest;
use App\Http\Resources\FlashcardResource;
use App\Models\Flashcard;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FlashcardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $flashcards = Flashcard::all();

        return FlashcardResource::collection($flashcards);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFlashcardRequest $request): FlashcardResource
    {
        $flashcard = Flashcard::create($request->validated());

        return new FlashcardResource($flashcard);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
