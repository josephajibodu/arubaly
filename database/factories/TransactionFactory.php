<?php

namespace Database\Factories;

use App\Enums\Currency;
use App\Enums\TradeStatus;
use App\Enums\TransactionType;
use App\Models\Conversion;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\Withdrawal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => fake()->numberBetween(2, 30) * 100,
            'reference' => Str::random(10),
            'description' => fake()->sentence,
            'status' => fake()->randomElement(TradeStatus::values()),
            'currency' => fake()->randomElement(Currency::values()),
            'type' => fake()->randomElement(TransactionType::values()),
        ];
    }

    /**
     * order transaction state
     */
    public function order(): static
    {
        return $this->state(fn (array $attributes) => [
            'currency' => Currency::AWG,
            'description' => 'Arubaly AWG order',
            'status' => TradeStatus::PENDING,
            'type' => TransactionType::ORDER,
        ]);
    }

    /**
     * transfer transaction state
     */
    public function transfer(): static
    {
        return $this->state(fn (array $attributes) => [
            'description' => 'Transfer to user',
            'status' => TradeStatus::PENDING,
            'type' => TransactionType::TRANSFER,
        ]);
    }

    /**
     * transfer transaction state
     */
    public function conversion(): static
    {
        return $this->state(fn (array $attributes) => [
            'description' => 'Conversion of currency',
            'status' => TradeStatus::PENDING,
            'type' => TransactionType::CONVERSION,
        ]);
    }

    /**
     * transfer transaction state
     */
    public function withdrawal(): static
    {
        return $this->state(fn (array $attributes) => [
            'description' => 'Withdrawal to local bank',
            'status' => TradeStatus::PENDING,
            'type' => TransactionType::WITHDRAWAL,
            'amount' => fake()->numberBetween(3000, 50000) * 100,
        ]);
    }
    //    /**
    //     * Configure the model factory.
    //     *
    //     * @return $this
    //     */
    //    public function configure(): static
    //    {
    //        return $this->afterCreating(function (Transaction $transaction) {
    //            switch ($transaction->type) {
    //                case TransactionType::CONVERSION:
    //                    Conversion::factory()->create(['transaction_id' => $transaction->id]);
    //                    break;
    //                case TransactionType::WITHDRAWAL:
    //                    Withdrawal::factory()->create(['transaction_id' => $transaction->id]);
    //                    break;
    //                case TransactionType::TRANSFER:
    //                    Transfer::factory()->create(['transaction_id' => $transaction->id]);
    //                    break;
    //                case TransactionType::ORDER:
    //                    Order::factory()->create(['transaction_id' => $transaction->id]);
    //                    break;
    //            }
    //        });
    //    }

}
