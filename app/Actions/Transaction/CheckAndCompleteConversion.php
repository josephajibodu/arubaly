<?php

namespace App\Actions\Transaction;

use App\Enums\TradeStatus;
use App\Enums\TransactionType;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckAndCompleteConversion
{
    public function __invoke()
    {
        try {
            $transactions = Transaction::query()
                ->where('type', TransactionType::CONVERSION)
                ->where('status', TradeStatus::PENDING)
                ->orderBy('created_at')
                ->take(10)
                ->get();

            foreach ($transactions as $transaction) {
                DB::transaction(function () use ($transaction) {
                    $conversion = $transaction->conversion;

                    // get the time left in seconds
                    $timeLeft = $conversion->getTimeLeft();

                    if ($timeLeft < 60) {
                        $payableAmount = $conversion->received_amount;

                        $transaction->update(['status' => TradeStatus::COMPLETED]);

                        $user = $transaction->user;

                        $user->credit($payableAmount, $conversion->to_currency);
                    }
                });
            }
        } catch (\Exception $ex) {
            Log::info("Error ".$ex->getMessage());
        }
    }
}
