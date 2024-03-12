<?php

namespace App\Livewire\Merchant;

use App\Actions\Transaction\CompleteArubaTrade;
use App\Enums\TradeStatus;
use App\Exceptions\InsufficientFundsException;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;

class BuyOrderDetails extends Component
{
    public Transaction $transaction;

    public bool $transactionExpired = false;

    public function render()
    {
        return view('livewire.merchant.buy-order-details');
    }

    public function mount(string $reference)
    {
        $this->transaction = Transaction::where('reference', $reference)->with(['order'])->first();
        $this->transactionExpired = $this->isExpired();
    }

    public function updateStatus(TradeStatus $status)
    {
        switch ($status) {
            case TradeStatus::CANCELLED:
                $this->transaction->update(['status' => $status]);
                $this->dispatch('error', 'Buy order has been cancelled.');
                break;
            case TradeStatus::PAYMENT_UNCONFIRMED:
                $this->transaction->update(['status' => $status]);
                $this->dispatch('info', 'Since you did not receive payment within the payment window, Order status updated accordingly.');
                break;
        }

        $this->transaction = $this->transaction->refresh();
    }

    public function confirmTransaction(CompleteArubaTrade $arubaTrade)
    {
        try {
            $arubaTrade->execute(
                $this->transaction
            );

            $this->dispatch('success', "Traded completed successfully.");

        } catch (InsufficientFundsException $exception) {
            report($exception);

            $this->dispatch('error', $exception);
        }
    }

    private function isExpired()
    {
        $expiry = Carbon::parse($this->transaction->created_at)->addMinutes($this->transaction->order->payment_limit);

        return $expiry->lessThan(now()) && $this->transaction->status == TradeStatus::PENDING;
    }

}
