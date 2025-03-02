<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\FlashcardFolder;
use Database\Factories\FlashcardFolderFactory;
use Illuminate\Database\Seeder;

class FlashcardFolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var FlashcardFolderFactory $factory */
        $factory = FlashcardFolder::factory();

        $factory->withFlashcards()->create(['name' => 'Car Brands']);
    }
}
