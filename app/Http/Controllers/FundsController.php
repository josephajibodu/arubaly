<?php

namespace App\Http\Controllers;

use App\Enums\Currency;
use Illuminate\Http\Request;

class FundsController extends Controller
{
    public function index()
    {
        $from = request()->query('from') ?? Currency::AWG->value;
        $to = request()->query('to') ?? Currency::USD->value;

        return view('protected.convert', [
            'from' => $from,
            'to' => $to
        ]);
    }
}
