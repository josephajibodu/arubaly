<?php

namespace Database\Factories;

use App\Enums\Currency;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversion>
 */
class ConversionFactory extends Factory
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
                return Transaction::factory()->conversion()->for($user)->create()->id;
            },
            'rate' => fake()->numberBetween(100, 1000),
            'to_currency' => fake()->randomElement(Currency::values()),
            'to_amount' => fake()->numberBetween(1000, 10000),
            'received_amount' => fake()->numberBetween(900, 950),
            'exchange_fee' => fake()->numberBetween(1, 50),
            'processing_time' => fake()->numberBetween(60, 300),
        ];
    }
}
