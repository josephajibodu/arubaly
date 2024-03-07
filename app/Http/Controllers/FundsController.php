<?php

namespace App\Http\Controllers;

use App\Enums\Currency;

class FundsController extends Controller
{
    public function index()
    {
        return view('protected.conversions-list');
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
