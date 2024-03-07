<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class BuyArubaController extends Controller
{
    public function index()
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
