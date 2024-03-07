<?php

namespace App\Actions\Transaction;

use App\Enums\Currency;
use App\Enums\TradeStatus;
use App\Enums\TransactionType;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BuyArubaCoin
{
    public function execute(User $user, User $merchant, float $amount)
    {
        $localAmount = $amount * 100;

        return DB::transaction(function () use ($merchant, $user, $localAmount) {
            $currency = Currency::AWG;

            // Create a new transaction for the buy order
            $transaction = Transaction::create([
                'amount' => $localAmount,
                'reference' => uniqid(), // You may want to generate a unique reference
                'description' => "Buy order for {$currency->label()}",
                'status' => TradeStatus::PENDING,
                'currency' => $currency,
                'type' => TransactionType::ORDER,
                'user_id' => $user->id,
            ]);

            // Create a new buy order associated with the transaction
            return $transaction->order()->create([
                'merchant_id' => $merchant->id,
                'rate' => $merchant->rate,
                'payable_currency' => Currency::NGN,
                'payment_limit' => 12, // 12 minutes
                'payable_amount' => $localAmount * $this->getExchangeRate($currency),
            ]);
        });
    }

    /**
     * Get the exchange rate (replace this with your logic to fetch the rate)
     *
     * @param Currency $currency
     * @return float
     */
    private function getExchangeRate(Currency $currency): float
    {
        // Replace this with your logic to fetch the exchange rate for the given currency
        // For simplicity, return a fixed rate here.
        return 1.2; // Replace with actual exchange rate logic
    }
}
