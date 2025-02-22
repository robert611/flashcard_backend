<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Flashcard;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlashcardFactory extends Factory
{
    protected $model = Flashcard::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'value' => $this->faker->sentence(),
            'owner_id' => User::factory(),
        ];
    }
}
