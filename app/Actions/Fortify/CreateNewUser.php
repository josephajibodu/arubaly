<?php

namespace App\Actions\Fortify;

use App\Enums\Currency;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)],
            'phonenumber' => ['required', 'string', 'regex:/^(\+234|0)([789][01])\d{8}/', 'max:15'],
            'whatsappnumber' => ['required', 'string', 'regex:/^(\+234|0)([789][01])\d{8}/', 'max:15'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),

            'bankname' => ['required', 'string', 'max:255'],
            'accountname' => ['required', 'string', 'max:255'],
            'accountnumber' => ['required', 'string', 'max:10']
        ])->validate();

        $cleanedPhoneNumber = preg_replace('/^(?:\+234|234)/', '', $input['phonenumber']);
        $cleanedWhatsAppNumber = preg_replace('/^(?:\+234|234)/', '', $input['whatsappnumber']);

        $user = User::create([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'username' => $input['username'],
            'phonenumber' => $cleanedPhoneNumber,
            'whatsappnumber' => $cleanedWhatsAppNumber,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),

            'bankname' => $input['bankname'],
            'accountname' => $input['accountname'],
            'accountnumber' => $input['accountnumber'],
        ]);

        // Create wallets for the user
        foreach (Currency::cases() as $currency) {
            Wallet::create([
                'currency' => $currency,
                'user_id' => $user->id
            ]);
        }

        return $user;
    }
}
