<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Flashcard;
use App\Models\FlashcardFolder;
use App\Models\User;
use Illuminate\Database\Seeder;

class FlashcardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        $flashcards = [
            ['name' => 'Capital of France', 'value' => 'Paris'],
            ['name' => 'Capital of Germany', 'value' => 'Berlin'],
            ['name' => 'Capital of Italy', 'value' => 'Rome'],
            ['name' => 'Capital of Spain', 'value' => 'Madrid'],
            ['name' => 'Capital of UK', 'value' => 'London'],
            ['name' => 'Capital of USA', 'value' => 'Washington D.C.'],
            ['name' => 'Capital of Canada', 'value' => 'Ottawa'],
            ['name' => 'Capital of Japan', 'value' => 'Tokyo'],
            ['name' => 'Capital of Australia', 'value' => 'Canberra'],
            ['name' => 'Capital of Brazil', 'value' => 'Brasilia'],
        ];

        /** @var FlashcardFolder $flashcardFolder */
        $flashcardFolder = FlashcardFolder::create([
            'name' => 'Famous capitals',
            'description' => 'This folder helps to learn countries and their capitals.',
            'owner_id' => $user->id,
        ]);

        foreach ($flashcards as $data) {
            Flashcard::create([
                'name' => $data['name'],
                'value' => $data['value'],
                'owner_id' => $user->id,
                'folder_id' => $flashcardFolder->id,
            ]);
        }
    }
}
