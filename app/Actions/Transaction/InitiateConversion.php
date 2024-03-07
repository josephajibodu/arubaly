<?php

namespace App\Actions\Transaction;

use App\Enums\Currency;
use App\Enums\TradeStatus;
use App\Enums\TransactionType;
use App\Exceptions\InsufficientFundsException;
use App\Models\Transaction;
use App\Models\User;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;

class InitiateConversion
{
    public function execute(User $user, float $amount, Currency $fromCurrency, Currency $toCurrency, bool $officialMarket = false)
    {
        $localAmount = $amount * 100;

        return DB::transaction(function () use ($localAmount, $user, $fromCurrency, $toCurrency) {
            // Create a new conversion transaction
            $transaction = Transaction::create([
                'amount' => $localAmount,
                'reference' => uniqid(), // You may want to generate a unique reference
                'description' => "Conversion: {$fromCurrency->label()} to {$toCurrency->label()}",
                'status' => TradeStatus::PENDING,
                'currency' => $fromCurrency,
                'type' => TransactionType::CONVERSION,
                'user_id' => $user->id,
            ]);

            // Create the associated conversion record
            $conversion = $transaction->conversion()->create([
                'rate' => $this->getConversionRate($fromCurrency, $toCurrency) * 100,
                'to_currency' => $toCurrency,
                'to_amount' => $localAmount * $this->getConversionRate($fromCurrency, $toCurrency) * 100,
                'received_amount' => $localAmount,
                'exchange_fee' => $this->calculateExchangeFee($localAmount),
            ]);

            // Debit the user's balance in the original currency
            $user->debit($localAmount, $fromCurrency);

            return $transaction;
        });
    }

    /**
     * Get the conversion rate between two currencies (for demonstration purposes, you might use an external API or database)
     *
     * @param Currency $fromCurrency
     * @param Currency $toCurrency
     * @return float
     */
    private function getConversionRate(Currency $fromCurrency, Currency $toCurrency): float
    {
        // Example: You might retrieve the conversion rate from an external API or database
        // For simplicity, return a fixed rate here.
        return 1.5; // Replace with actual conversion logic
    }

    /**
     * Calculate the exchange fee (for demonstration purposes, you might have a more sophisticated fee structure)
     *
     * @param float $amount
     * @return float
     */
    private function calculateExchangeFee(float $amount): float
    {
        // Example: You might have a more complex fee calculation based on the amount or other factors
        // For simplicity, return a fixed fee here.
        return $amount * 0.01; // 1% fee
    }
}
