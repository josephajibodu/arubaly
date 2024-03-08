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

    public function merchantProfile()
    {
        $user = auth()->user();

        return view('protected.merchants.index', ['user' => $user]);
    }

    public function merchantDetailsUpdate(Request $request)
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
