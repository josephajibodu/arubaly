<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transfer>
 */
class TransferFactory extends Factory
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
                return Transaction::factory()->transfer()->for($user)->create()->id;
            },
            'recipient_id' => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}
