<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class BuyAruba extends Component
{
    public ?User $merchant = null;

    public array $merchants = [];

    public function selectMerchant(int $userId)
    {
        $user = User::find($userId);
        $this->merchant = $user;
    }

    public function render()
    {
        return view('livewire.buy-aruba');
    }

    public function mount()
    {
    }
}
