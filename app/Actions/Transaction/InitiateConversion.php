<?php

namespace App\Actions\Transaction;

use App\Enums\Currency;
use App\Enums\TradeStatus;
use App\Enums\TransactionType;
use App\Exceptions\InsufficientFundsException;
use App\Models\Transaction;
use App\Models\User;
use App\Settings\GeneralSetting;
use Exception;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;

class InitiateConversion
{
    public function __construct(
        public GeneralSetting $setting,
    )
    {}

    public function execute(User $user, float $amount, Currency $fromCurrency, Currency $toCurrency, bool $isParallel = false)
    {
        $localAmount = $amount * 100;

        return DB::transaction(function () use ($isParallel, $localAmount, $user, $fromCurrency, $toCurrency) {
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

            $convertedAmount = $localAmount * $this->getConversionRate($fromCurrency);

            $exchangeFee = $this->calculateExchangeFee($convertedAmount);

            $processingTime = match ($fromCurrency) {
                Currency::USD => $isParallel ? $this->setting->usd_to_naira_processing_time_parallel_market : $this->setting->usd_to_naira_processing_time_official,
                Currency::AWG => $this->setting->aruba_to_usd_processing_time,
                Currency::NGN => throw new Exception('To be implemented')
            };

            $transaction->conversion()->create([
                'rate' => $this->getConversionRate($fromCurrency) * 100,
                'to_currency' => $toCurrency,
                'to_amount' => $convertedAmount,
                'received_amount' => $convertedAmount - $exchangeFee,
                'exchange_fee' => $exchangeFee,
                'processing_time' => $processingTime,
            ]);

            // Debit the user's balance in the original currency
            $user->debit($localAmount, $fromCurrency);

            return $transaction;
        });
    }

    /**
     * Get the conversion rate between two currencies
     *
     * @param Currency $fromCurrency
     * @param bool $isParallel
     * @return float
     */
    private function getConversionRate(Currency $fromCurrency, bool $isParallel = true): float
    {
        if ($fromCurrency == Currency::AWG) {
            return $this->setting->awg_rate;
        }

        if ($fromCurrency == Currency::USD && $isParallel) {
            return $this->setting->usd_rate_parallel;
        }

        return $this->setting->usd_rate_official;
    }

    /**
     * Calculate the exchange fee
     *
     * @param float $amount
     * @return float
     */
    private function calculateExchangeFee(float $amount): float
    {
        return $amount * ($this->setting->exchange_fee_percentage * 0.01);
    }
}
