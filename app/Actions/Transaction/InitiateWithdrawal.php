<?php

namespace App\Actions\Transaction;

use App\Enums\Currency;
use App\Enums\TradeStatus;
use App\Enums\TransactionType;
use App\Exceptions\InsufficientFundsException;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;

class InitiateWithdrawal
{
    public function execute(User $user, float $amount)
    {
        $localAmount = $amount * 100;

        return DB::transaction(function () use ($localAmount, $user) {

            // Debit the user's balance
            $user->debit($localAmount, Currency::NGN);

            // Create a new withdrawal transaction
            $transaction = Transaction::create([
                'amount' => $localAmount,
                'reference' => uniqid(),
                'description' => 'Withdrawal to local bank',
                'status' => TradeStatus::PENDING,
                'currency' => Currency::NGN,
                'type' => TransactionType::WITHDRAWAL,
                'user_id' => $user->id,
            ]);

            // Create the associated withdrawal record
            $transaction->withdrawal()->create([
                'bankname' => $user->bankname,
                'accountname' => $user->accountname,
                'accountnumber' => $user->accountnumber,
            ]);

            return $transaction;
        });
    }
}
