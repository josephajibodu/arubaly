<?php

namespace App\Http\Controllers;

use App\Enums\MerchantAvailability;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $transactions = $user->transactions()->desc()->simplePaginate(10);

        return view('protected.home', ['user' => $user, 'transactions' => $transactions]);
    }

    public function profile()
    {
        $user = auth()->user();

        return view('protected.profile', ['user' => $user]);
    }

    public function updateBankDetails(Request $request)
    {
        $input = $request->validate([
            'bankname' => ['required', 'string', 'max:255'],
            'accountname' => ['required', 'string', 'max:255'],
            'accountnumber' => ['required', 'string', 'min:10', 'max:10'],
        ]);

        $user = User::find(auth()->id());

        $user->update([
            'bankname' => $input['bankname'],
            'accountname' => $input['accountname'],
            'accountnumber' => $input['accountnumber'],
        ]);

        session()->flash('success', 'Banking details updated successfully');

        return redirect()->back();
    }
}
