<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(auth()->id());
        $withdrawals = $user->withdrawals()->with('withdrawal')->desc()->simplePaginate(25);

        return view('protected.withdrawals-list', ['transactions' => $withdrawals]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('protected.withdraw');
    }
}
