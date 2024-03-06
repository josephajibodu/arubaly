<?php

namespace App\Livewire;

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
        $this->merchant = $user;
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
        $this->merchants = User::with(['awg', 'usd', 'ngn'])->where('rate', '>', 0)->get();

        $this->merchant = User::with(['awg', 'usd', 'ngn'])->where('rate', '>', 0)->inRandomOrder()->first();
    }

    public function buy()
    {

    }

    public function calculate()
    {
        $this->payableAmount = ($this->merchant->rate * floatval($this->amount ?? 0)) / 100;
    }

    private function calculateInverse()
    {
        $this->amount = (floatval($this->payableAmount ?? 0) / $this->merchant->rate);
    }
}
