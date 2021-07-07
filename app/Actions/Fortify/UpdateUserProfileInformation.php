<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'fname' => ['required', 'string', 'max:80'],
            'lname' => ['required', 'string', 'max:80'],
            'dob' => ['required'],
            'gender' => ['required'],
             'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'number' => ['required'],
            'type' => ['required'],
           
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'fname' => $input['fname'],
                'lname' => $input['lname'],
                'dob' => $input['dob'],
                'gender' =>'female',
                'email' => $input['email'],
                'number' => $input['number'],
                'type' => 'primary',
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'fname' => $input['fname'],
            'lname' => $input['lname'],
            'dob' => $input['dob'],
            'gender' =>'female',
            'email' => $input['email'],
            'email_verified_at' => null,
            'number' => $input['number'],
            'type' => 'primary',
            
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
