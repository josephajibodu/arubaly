<?php

namespace App\Actions\Transaction;

use App\Enums\Currency;
use App\Enums\TradeStatus;
use App\Enums\TransactionType;
use App\Models\Transaction;
use App\Models\User;
use App\Settings\GeneralSetting;
use Illuminate\Support\Facades\DB;

class CompleteArubaTrade
{
    public function execute(Transaction $transaction)
    {
        return DB::transaction(function () use ($transaction) {
            $merchant = $transaction->order->merchant;
            $user = $transaction->user;

            // Update the transaction
            $transaction->update([
                'status' => TradeStatus::PAYMENT_CONFIRMED,
            ]);

            // Debit Merchant
            $merchant->debit($transaction->amount, $transaction->currency);

            // Credit User
            $user->credit($transaction->amount, $transaction->currency);

            $transaction->update([
                'status' => TradeStatus::COMPLETED,
            ]);

            return $transaction->refresh();
        });
    }
}
