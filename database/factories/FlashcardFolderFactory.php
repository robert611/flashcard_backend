<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Flashcard;
use App\Models\FlashcardFolder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlashcardFolderFactory extends Factory
{
    protected $model = FlashcardFolder::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'owner_id' => User::factory(),
        ];
    }

    public function withFlashcards(int $amount = 10): self
    {
        return $this->has(Flashcard::factory()->count($amount), 'flashcards');
    }
}
