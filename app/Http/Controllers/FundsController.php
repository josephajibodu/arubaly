<?php

namespace App\Http\Controllers;

use App\Enums\Currency;
use App\Models\User;

class FundsController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->id());
        $conversions = $user->conversions()->with('conversion')->desc()->simplePaginate(25);

        return view('protected.conversions-list', ['transactions' => $conversions]);
    }

    public function create()
    {
        $from = request()->query('from') ? Currency::from(request()->query('from')) : Currency::AWG;
        $to = request()->query('to') ? Currency::from(request()->query('to')) : Currency::USD;

        return view('protected.convert', [
            'from' => $from,
            'to' => $to,
        ]);
    }
}
