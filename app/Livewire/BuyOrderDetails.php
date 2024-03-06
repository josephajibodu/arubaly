<?php

namespace App\Livewire;

use App\Enums\TradeStatus;
use App\Models\Order;
use App\Models\Transaction;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class BuyOrderDetails extends Component
{
    use WithFileUploads;

    public Transaction $transaction;

    #[Validate('image|max:2048')] // 2MB Max
    public $payment_proof;

    public function render()
    {
        return view('livewire.buy-order-details');
    }

    public function mount(string $reference)
    {
        $this->transaction = Transaction::where('reference', $reference)->with(['order'])->first();
    }

    public function saveUploadProof()
    {
        $this->validate([
            'payment_proof' => 'image|max:2048',
        ], [
            'payment_proof.image' => 'Please upload a valid payment proof'
        ]);

        $path = $this->payment_proof->store(path: 'payment_proof');

        // upload the file path and status to payment paid
        $this->transaction->order->update([
            'payment_proof' => $path,
        ]);

        $this->transaction->update([
            'status' => TradeStatus::PAYMENT_SENT
        ]);

    }

    public function cancelTrade()
    {
        $this->transaction->update([
            'status' => TradeStatus::CANCELLED
        ]);

        $this->transaction = $this->transaction->refresh();
    }
}

