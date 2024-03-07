<?php

namespace App\Livewire;

use App\Actions\Transaction\InitiateConversion;
use App\Enums\Currency;
use App\Exceptions\InsufficientFundsException;
use App\Models\User;
use App\Settings\GeneralSetting;
use Illuminate\Support\Number;
use Livewire\Component;

class ConvertFunds extends Component
{
    public Currency $from;

    public Currency $to;

    public bool $isParallel = true;

    public float $rate = 0.00;

    public float $amount;

    public float $amountReceived;

    public User $user;

    public function render()
    {
        return view('livewire.convert-funds');
    }

    public function mount(Currency $from, Currency $to, bool $isParallel = true)
    {
        $this->from = $from;
        $this->to = $to;
        $this->isParallel = $isParallel;

        // get the rate based on the from and to
        $this->rate = $this->getRate($from, $isParallel);
        $this->user = User::find(auth()->id());

    }

    public function setParallel(bool $isParallel)
    {
        $this->isParallel = $isParallel;

        $this->rate = $this->getRate($this->from, $this->isParallel);
    }

    public function updated($property)
    {
        //        dd($property);
        if ($property == 'amount') {
            if (!isset($this->amount) || !$this->amount) {
                $this->addError('amount', 'Please input a valid amount');
                return;
            }

            $this->calculate();
        }

        if ($property == 'amountReceived') {
            if (!isset($this->amountReceived) || !$this->amountReceived) {
                $this->addError('amountReceived', 'Please input a valid amount');
                return;
            }

            $this->calculateInverse();
        }
    }

    public function convert(InitiateConversion $conversion)
    {
        $this->validate([
            'amount' => 'numeric|min:1',
        ], [
            'amount.numeric' => 'Please input a valid amount'
        ]);

        try {
            $conversion->execute(
                user: $this->user,
                amount: $this->amount,
                fromCurrency: $this->from,
                toCurrency: $this->to
            );

            $this->dispatch('success', "Conversion initiated successfully. Feel free to monitor your dashboard for real-time updates on the remaining time.");

            $this->reset('amount', 'amountReceived');
            $this->user = User::find(auth()->id());
        } catch (InsufficientFundsException $exception) {
            report($exception);

            $this->dispatch('error', $exception);
        }
    }

    private function getRate(Currency $from, bool $isParallel): float
    {
        $settings = app(GeneralSetting::class);

        if ($from == Currency::AWG) {
            return $settings->awg_rate;
        }

        if ($from == Currency::USD && $isParallel) {
            return $settings->usd_rate_parallel;
        }

        return $settings->usd_rate_official;
    }

    public function calculate()
    {
        $settings = app(GeneralSetting::class);

        $amountYoullReceive = $this->rate * $this->amount * (100 - $settings->exchange_fee_percentage) * 0.01;
        $this->amountReceived = (float) sprintf("%.2f", $amountYoullReceive);
    }

    private function calculateInverse()
    {
        $settings = app(GeneralSetting::class);

        $amountToConvert = $this->amountReceived / ($this->rate * (100 - $settings->exchange_fee_percentage) * 0.01);
        $this->amount = (float) sprintf("%.2f", $amountToConvert);
    }
}
