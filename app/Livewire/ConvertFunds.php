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

    public float $amount;

    public float $amountRecieved;

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

    private function getRate(Currency $from, Currency $to, bool $isParallel): int
    {
        return rand(100, 300);
    }
}
