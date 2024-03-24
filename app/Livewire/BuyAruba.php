<?php

namespace App\Livewire;

use App\Actions\Transaction\BuyArubaCoin;
use App\Enums\Currency;
use App\Exceptions\InsufficientFundsException;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class BuyAruba extends Component
{
    public ?User $merchant = null;

    public Collection $merchants;

    public float $amount;

    public float $payableAmount;

    public function selectMerchant(int $userId)
    {
        $user = User::with(['awg', 'usd', 'ngn'])->find($userId);
        if ($userId == auth()->id()) return;

        $this->merchant = $user;
    }

    public function goBack()
    {
        $this->merchant = null;
    }

    public function updated($property)
    {
        if ($property == 'amount') {
            $this->calculate();
        } elseif ($property == 'payableAmount') {
            $this->calculateInverse();
        }
    }

    public function render()
    {
        return view('livewire.buy-aruba');
    }

    public function mount()
    {
        // TODO: create a better way to get merchants
        $this->merchants = User::role('merchant')->get();
    }

    public function buy(BuyArubaCoin $buyArubaCoin)
    {
        $this->validate([
            'amount' => 'numeric|min:1',
        ], [
            'amount.numeric' => 'Please input a valid amount'
        ]);

        $this->calculate();

        if (! $this->merchant->hasSufficientBalance($this->amount * 100, Currency::AWG)) {
            $this->addError('amount', 'The merchant does not currently have sufficient amount of Aruba(AWG) at the moment, Buy from other available merchant or check back later');
            return;
        }

        // check that the naira equivalent is within the merchants min and max
        $compareAmount = $this->payableAmount * 100;

        if ($compareAmount < $this->merchant->min_amount || $compareAmount > $this->merchant->max_amount) {
            $this->addError('payableAmount', 'Please ensure your payable amount is withing the merchants limit');
            return;
        }

        try {
            $transaction = $buyArubaCoin->execute(
                user: User::find(auth()->id()),
                merchant: $this->merchant,
                amount: $this->amount
            );

            $this->dispatch('success', "Buy Order Created");

            $this->user = User::find(auth()->id());

            $this->redirectRoute('transaction.buy-awg.show',  ['order' => $transaction]);
        } catch (InsufficientFundsException $exception) {
            report($exception);

            $this->dispatch('error', $exception);
        }
    }

    public function calculate()
    {
        $this->clearValidation();

        $this->payableAmount = ($this->merchant->rate * floatval($this->amount ?? 0)) / 100;
    }

    private function calculateInverse()
    {
        $this->clearValidation();

        $this->amount = (floatval($this->payableAmount ?? 0) / $this->merchant->rate);
    }
}
