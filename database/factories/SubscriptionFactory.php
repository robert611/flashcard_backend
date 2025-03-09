<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscription::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'type' => $this->faker->randomElement(['basic', 'premium', 'enterprise']),
            'stripe_id' => 'sub_' . Str::random(14),
            'stripe_status' => $this->faker->randomElement(['active', 'trialing', 'canceled', 'past_due']),
            'stripe_price' => $this->faker->randomElement(['price_1JY7y7Lb9h3KzZnQxXqzG2GK', 'price_1JY7zFLb9h3KzZnQYtYF9MJJ']),
            'quantity' => $this->faker->numberBetween(1, 5),
            'trial_ends_at' => $this->faker->optional()->dateTimeBetween('now', '+14 days'),
            'ends_at' => $this->faker->optional()->dateTimeBetween('now', '+1 year'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
