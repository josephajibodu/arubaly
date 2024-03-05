<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuyArubaController extends Controller
{
    public function index()
    {
        return view('protected.buy-awg');
    }
}
