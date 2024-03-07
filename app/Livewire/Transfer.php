<?php

namespace App\Livewire;

use App\Actions\Transaction\InitiateTransfer;
use App\Enums\Currency;
use App\Exceptions\InsufficientFundsException;
use App\Models\User;
use Exception;
use Livewire\Component;

class Transfer extends Component
{
    public float $amount;

    public string $recipient;

    public ?User $recipientModel;

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
        $this->recipient = '';
    }

    public function updated($property)
    {
        if ($property == 'currency') {
            $this->clearValidation();
            $this->reset('amount');
        }
    }

    public function transfer(InitiateTransfer $initiateTransfer)
    {
        $this->validate([
            'amount' => 'numeric|min:100',
        ], [
            'amount.min' => 'Amount to transfer must be at least 100',
            'amount.numeric' => 'Please enter a valid amount',
        ]);

        // check users balance
        switch ($this->currency) {
            case Currency::USD:
                if ($this->amount * 100 > $this->user->usd->balance) {
                    $this->addError('amount', 'Amount to transfer should be less than the available balance');
                    return;
                }
                break;
            case Currency::AWG:
                if ($this->amount * 100 > $this->user->awg->balance) {
                    $this->addError('amount', 'Amount to transfer should be less than the available balance');
                    return;
                }
                break;
        }

        // create the transfer
        try {
            $initiateTransfer->execute(from: $this->user, to: $this->recipientModel, amount: $this->amount, currency: $this->currency);

//            session()->flash('success', "You have successfully transferred $this->amount {$this->currency->label()} to $this->recipient.");
//            $this->redirectRoute('transaction.transfer');

            $this->dispatch('success', "You have successfully transferred $this->amount {$this->currency->label()} to $this->recipient.");

            $this->reset();
        } catch (InsufficientFundsException $exception) {
            report($exception);

//            session()->flash('error', $exception);
            $this->dispatch('error', $exception);

//            $this->redirectRoute('transaction.transfer');
        }
    }

    public function findUser()
    {
        $this->recipientModel = null;

        if (! $this->recipient) {
            $this->addError('recipient', 'Please enter the recipient username');
            return;
        }

        $user = User::where('username', $this->recipient)->first();

        if (! $user) {
            $this->resetErrorBag('recipient');
            $this->addError('recipient', 'User with this username does not exist.');
            return;
        }

        if ($user->id == $this->user->id) {
            $this->resetErrorBag('recipient');
            $this->addError('recipient', 'You cannot transfer to yourself.');
            return;
        }

        $this->recipientModel = $user;
        $this->clearValidation();
    }
}
