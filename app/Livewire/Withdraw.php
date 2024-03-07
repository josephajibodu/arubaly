<?php

namespace App\Livewire;

use App\Actions\Transaction\InitiateWithdrawal;
use App\Exceptions\InsufficientFundsException;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Support\Number;
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

    }

    public function withdraw(InitiateWithdrawal $withdrawal)
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



        // create the transfer
        try {
            $withdrawal->execute(
                user: $this->user,
                amount: $this->amount
            );

            $withdrawalAmount = Number::format($this->amount);
            $this->dispatch('success', "Withdrawal successful. ₦$withdrawalAmount will be sent to the provided bank account.");

            $this->reset();
            $this->user = User::find(auth()->id());
        } catch (InsufficientFundsException $exception) {
            report($exception);

            $this->dispatch('error', $exception);
        }
    }
}
