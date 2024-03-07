<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Withdrawal;
use Livewire\Component;

class Withdraw extends Component
{
    public float $amount;

    public User $user;

    public function render()
    {
        return view('livewire.withdraw');
    }

    public function mount()
    {
        $this->user = User::find(auth()->id());
    }

    public function updated($property)
    {
        if ($property == 'amount') {
            if ($this->amount * 100 > $this->user->ngn->balance) {
                $this->addError('amount', 'Withdrawal amount should be less than balance');
            }
        }
    }

    public function withdraw()
    {
        $this->validate([
            'amount' => 'numeric|min:1000',
        ], [
            'amount.min' => 'Withdrawal amount must be at least ₦1000',
            'amount.numeric' => 'Please enter a valid amount',
        ]);

        if ($this->amount * 100 > $this->user->ngn->balance) {
            $this->addError('amount', 'Withdrawal amount should be less than balance');

            return;
        }

        // create the withdrawal
        $withdrawal = Withdrawal::create([
            'amount' => $this->amount * 100,
        ]);

        // or create an action that creates each of these transactions

    }
}
