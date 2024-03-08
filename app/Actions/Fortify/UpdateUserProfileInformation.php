<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {

        Validator::make($input, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phonenumber' => ['required', 'string', 'regex:/^(\+234|0)([789][01])\d{8}/', 'max:15'],
            'whatsappnumber' => ['required', 'string', 'regex:/^(\+234|0)([789][01])\d{8}/', 'max:15'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ])->validate();
//        ])->validateWithBag('updateProfileInformation');

        $cleanedPhoneNumber = preg_replace('/^(?:\+234|234|0)/', '', $input['phonenumber']);
        $cleanedWhatsAppNumber = preg_replace('/^(?:\+234|234|0)/', '', $input['whatsappnumber']);

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'firstname' => $input['firstname'],
                'lastname' => $input['lastname'],
                'phonenumber' => $cleanedPhoneNumber,
                'whatsappnumber' => $cleanedWhatsAppNumber,

                'email' => $input['email'],
            ])->save();
        }

        session()->flash('success', 'Personal Information updated successfully.');
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $cleanedPhoneNumber = preg_replace('/^(?:\+234|234|0)/', '', $input['phonenumber']);
        $cleanedWhatsAppNumber = preg_replace('/^(?:\+234|234|0)/', '', $input['whatsappnumber']);


        $user->forceFill([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'phonenumber' => $cleanedPhoneNumber,
            'whatsappnumber' => $cleanedWhatsAppNumber,

            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
