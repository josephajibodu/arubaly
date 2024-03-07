<?php

namespace App\Actions\Transaction;

use App\Enums\Currency;
use App\Enums\TradeStatus;
use App\Enums\TransactionType;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class InitiateTransfer
{
    public function execute(User $from, User $to, float $amount, Currency $currency)
    {
        $localAmount = $amount * 100;

        return DB::transaction(function () use ($from, $to, $localAmount, $currency) {
            // Create a new transaction record for the transfer
            $transaction = Transaction::create([
                'amount' => $localAmount,
                'reference' => uniqid(), // You may want to generate a unique reference
                'description' => "Transfer to $to->username",
                'status' => TradeStatus::PENDING,
                'currency' => $currency,
                'type' => TransactionType::TRANSFER,
                'user_id' => $from->id,
            ]);

            // Create the associated transfer record
            $transaction->transfer()->create([
                'recipient_id' => $to->id,
            ]);

            // Update the sender's balance (assuming you have a balance field in the User model)
            $from->debit($localAmount, $currency);

            // Update the recipient's balance
            $to->credit($localAmount, $currency);

            $transaction->update(['status' => TradeStatus::COMPLETED]);

            return $transaction;
        });
    }
}
