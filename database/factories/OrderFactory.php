<?php

namespace Database\Factories;

use App\Enums\Currency;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::find(1);

        return [
            'transaction_id' => function () use ($user) {
                return Transaction::factory()->order()->for($user)->create()->id;
            },
            'merchant_id' => function () {
                return User::factory()->merchant()->create()->id;
            },
            'rate' => fake()->numberBetween(100, 1000),
            'payable_currency' => Currency::NGN,
            'payment_limit' => 12, // 12 minutes
            'payable_amount' => fake()->numberBetween(500, 5000),
        ];
    }
}
