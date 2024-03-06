<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Withdrawal>
 */
class WithdrawalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transaction_id' => function () {
                return Transaction::factory()->withdrawal()->create()->id;
            },
            'bankname' => fake()->company,
            'accountname' => fake()->name,
            'accountnumber' => str_pad(rand(1, 9999999999), 10, '0', STR_PAD_LEFT),
        ];
    }
}
