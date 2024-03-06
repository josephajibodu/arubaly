<?php

namespace App\Livewire;

use App\Enums\Currency;
use App\Models\User;
use Livewire\Component;

class Transfer extends Component
{
    public float $amount;

    public string $recipient;

    public User $user;

    public Currency $currency;


    public function render()
    {
        return view('livewire.transfer');
    }

    public function mount()
    {
        $this->user = User::find(auth()->id());
        $this->currency = Currency::USD;
    }

    public function updated($property)
    {
        if ($property == 'amount') {
            switch ($this->currency) {
                case Currency::USD:
                    if ($this->amount * 100 > $this->user->usd->balance) {
                        $this->addError('amount', 'Amount to transfer should be less than the available balance');
                    }
                    break;
            case Currency::AWG:
                if ($this->amount * 100 > $this->user->awg->balance) {
                    $this->addError('amount', 'Amount to transfer should be less than the available balance');
                }
                break;
            }
        }

        if ($property == 'currency') {
            $this->clearValidation();
            $this->reset('amount');
        }
    }

    public function transfer()
    {
        $this->validate([
            'amount' => 'numeric|min:1000',
        ], [
            'amount.min' => 'Amount to transfer must be at least ₦1000',
            'amount.numeric' => 'Please enter a valid amount'
        ]);

        // create the transfer


        // or create an action that creates each of these transactions

    }
}
