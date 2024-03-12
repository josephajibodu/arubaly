<?php

namespace App\Actions\Admin;

use App\Enums\TradeStatus;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class CancelOrder
{
    public function execute(Transaction $transaction)
    {
        return DB::transaction(function () use ($transaction) {
            $merchant = $transaction->order->merchant;
            $user = $transaction->user;

            // Update the transaction
            $transaction->update([
                'status' => TradeStatus::CANCELLED,
            ]);

            // Debit Merchant
            $merchant->credit($transaction->amount, $transaction->currency);

            // Credit User
            $user->debit($transaction->amount, $transaction->currency);

            return $transaction->refresh();
        });
    }
}
