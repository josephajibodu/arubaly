<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;

class BuyArubaController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->id());
        $orders = $user->orders()->desc()->simplePaginate(25);

        return view('protected.buy-awg-orders', ['transactions' => $orders]);
    }

    public function create()
    {
        return view('protected.buy-awg');
    }

    public function show(Transaction $order)
    {
        return view('protected.transactions.order', [
            'order' => $order,
        ]);
    }
}
