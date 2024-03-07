<?php

namespace App\Livewire;

use App\Enums\Currency;
use Livewire\Component;

class ConvertFunds extends Component
{
    public Currency $from;

    public Currency $to;

    public bool $isParallel = true;

    public float $rate = 0.00;

    public float $amount = 0;

    public float $amountReceived = 0;

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
        $this->rate = $this->getRate($from, $to, $isParallel);
    }

    public function setParallel(bool $isParallel)
    {
        $this->isParallel = $isParallel;
    }

    public function updated($property)
    {
        //        dd($property);
        if ($property == 'amount') {
            $this->calculate();
        } elseif ($property == 'amountReceived') {
            $this->calculateInverse();
        }
    }

    public function convert()
    {

    }

    private function getRate(Currency $from, Currency $to, bool $isParallel): int
    {
        return rand(100, 300);
    }

    public function calculate()
    {
        $this->amountReceived = $this->rate * $this->amount;
    }

    private function calculateInverse()
    {
        $this->amount = $this->amountReceived / $this->rate;
    }
}
