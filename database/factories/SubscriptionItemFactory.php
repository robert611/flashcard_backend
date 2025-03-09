<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\SubscriptionItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubscriptionItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubscriptionItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subscription_id' => Subscription::factory(),
            'stripe_id' => 'si_' . Str::random(14),
            'stripe_product' => $this->faker->randomElement([
                'prod_NqXK0F9jRkXv9T',
                'prod_MbKJzF9jGxPv6Y'
            ]),
            'stripe_price' => $this->faker->randomElement([
                'price_1JY7y7Lb9h3KzZnQxXqzG2GK',
                'price_1JY7zFLb9h3KzZnQYtYF9MJJ'
            ]),
            'quantity' => $this->faker->numberBetween(1, 5),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
