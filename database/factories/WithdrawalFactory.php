<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
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
        $user = User::find(1);

        return [
            'transaction_id' => function () use ($user) {
                return Transaction::factory()->withdrawal()->for($user)->create()->id;
            },
            'bankname' => fake()->company,
            'accountname' => fake()->name,
            'accountnumber' => str_pad(rand(1, 9999999999), 10, '0', STR_PAD_LEFT),
        ];
    }
}
