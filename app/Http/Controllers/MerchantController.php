<?php

namespace App\Http\Controllers;

use App\Enums\MerchantAvailability;
use App\Models\Merchant;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->id());
        $orders = Transaction::merchantOrders($user->id)->with('order')->desc()->simplePaginate(25);

        return view('protected.merchants.orders', ['transactions' => $orders]);
    }

    public function edit()
    {
        $user = auth()->user();

        return view('protected.merchants.index', ['user' => $user]);
    }

    public function view(Transaction $order)
    {
        $user = auth()->user();

        return view('protected.merchants.order-details', [
            'user' => $user,
            'reference' => $order->reference
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $input = $request->validate([
            'rate' => ['required', 'numeric', 'min:1'],
            'min_amount' => ['required', 'string', 'min:1'],
            'max_amount' => ['required', 'string', 'min:1'],
            'payment_type' => ['required', 'string', 'max:255'],
            'availability' => ['nullable'],
            'terms' => ['nullable', 'string', 'max:500'],
        ]);

        $user = User::find(auth()->id());

        $user->update([
            'rate' => $input['rate'] * 100,
            'min_amount' => $input['min_amount'] * 100,
            'max_amount' => $input['max_amount'] * 100,
            'payment_type' => $input['payment_type'],
            'availability' => isset($input['availability']) && $input['availability'] ? MerchantAvailability::AVAILABLE : MerchantAvailability::SOLDOUT,
            'terms' => $input['terms'],
        ]);

        session()->flash('success', 'Trading details updated successfully');

        return redirect()->back();
    }
}
