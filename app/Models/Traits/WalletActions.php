<?php

namespace App\Models\Traits;

use App\Enums\Currency;
use App\Exceptions\InsufficientFundsException;
use App\Models\Wallet;
use InvalidArgumentException;

trait WalletActions
{
    /**
     * Credit the user's balance.
     *
     * @param float $amount
     * @param Currency $currency
     * @return void
     */
    public function credit(float $amount, Currency $currency): void
    {
        $this->validatePositiveAmount($amount);

        $wallet = $this->getWallet($currency);
        $wallet->balance += $amount;
        $wallet->save();
    }

    /**
     * Debit the user's balance.
     *
     * @param float $amount
     * @param Currency $currency
     * @throws InsufficientFundsException
     */
    public function debit(float $amount, Currency $currency): void
    {
        $this->validatePositiveAmount($amount);

        $wallet = $this->getWallet($currency);

        if ($wallet->balance < $amount) {
            throw new InsufficientFundsException('Insufficient funds for withdrawal.');
        }

        $wallet->balance -= $amount;
        $wallet->save();
    }

    /**
     * Check if the user has sufficient balance.
     *
     * @param float $amount
     * @param Currency $currency
     * @return bool
     */
    public function hasSufficientBalance(float $amount, Currency $currency): bool
    {
        $this->validatePositiveAmount($amount);

        $wallet = $this->getWallet($currency);

        return $wallet->balance >= $amount;
    }

    /**
     * Validate that the amount is positive.
     *
     * @param float $amount
     * @return void
     * @throws InvalidArgumentException
     */
    protected function validatePositiveAmount(float $amount): void
    {
        if ($amount <= 0) {
            throw new InvalidArgumentException('Amount must be a positive value.');
        }
    }

    /**
     * Get the user's wallet for a specific currency.
     *
     * @param Currency $currency
     * @return Wallet
     */
    protected function getWallet(Currency $currency): Wallet
    {
        return $this->wallets()->firstOrCreate(['currency' => $currency]);
    }
}
