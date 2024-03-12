<?php

namespace App\Livewire;

use App\Enums\TradeStatus;
use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class BuyOrderDetails extends Component
{
    use WithFileUploads;

    public Transaction $transaction;

    #[Validate('image|max:2048')] // 2MB Max
    public $payment_proof;

    public bool $transactionExpired = false;

    public function render()
    {
        return view('livewire.buy-order-details');
    }

    public function mount(string $reference)
    {
        $this->transaction = Transaction::where('reference', $reference)->with(['order'])->first();
        $this->transactionExpired = $this->isExpired();
    }

    public function saveUploadProof()
    {
        $this->validate([
            'payment_proof' => 'image|max:2048',
        ], [
            'payment_proof.image' => 'Please upload a valid payment proof',
        ]);

        if ($this->transactionExpired = $this->isExpired()) {
            return;
        }

        $path = $this->payment_proof->store(path: 'payment_proof');

        // upload the file path and status to payment paid
        $this->transaction->order->update([
            'payment_proof' => $path,
        ]);

        $this->transaction->update([
            'status' => TradeStatus::PAYMENT_SENT,
        ]);

    }

    public function cancelTrade()
    {
        $this->transaction->update([
            'status' => TradeStatus::CANCELLED,
        ]);

        $this->transaction = $this->transaction->refresh();
    }

    private function isExpired()
    {
        $expiry = Carbon::parse($this->transaction->created_at)->addMinutes($this->transaction->order->payment_limit);

        return $expiry->lessThan(now()) && $this->transaction->status == TradeStatus::PENDING;
    }
}
