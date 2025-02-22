<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\Flashcard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FlashcardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_flashcards(): void
    {
        Flashcard::factory()->count(3)->create();

        $response = $this->getJson('/api/flashcards');

        $response->assertStatus(200);

        $response->assertJsonCount(3, 'data');
    }

    public function test_store_creates_flashcard(): void
    {
        $user = User::factory()->create();

        $flashcardData = [
            'name' => 'Test Flashcard',
            'value' => 'This is a test value',
            'owner_id' => $user->id,
        ];

        $response = $this->postJson('/api/flashcards', $flashcardData);

        $response->assertStatus(201);

        $this->assertDatabaseHas('flashcard', $flashcardData);
    }

    public function test_it_requires_all_fields_to_create_a_flashcard(): void
    {
        $response = $this->postJson('/api/flashcards');

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'value', 'owner_id']);
    }

    public function test_it_requires_name_to_be_a_string(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/flashcards', [
            'name' => 123,
            'value' => 'Some value',
            'owner_id' => $user->id,
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name']);
    }

    public function test_it_requires_value_to_be_a_string(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/flashcards', [
            'name' => 'Valid Name',
            'value' => 123,
            'owner_id' => $user->id,
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['value']);
    }

    public function test_it_requires_owner_id_to_exist_in_users_table(): void
    {
        $response = $this->postJson('/api/flashcards', [
            'name' => 'Valid Name',
            'value' => 'Some value',
            'owner_id' => 9999,
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['owner_id']);
    }
}
