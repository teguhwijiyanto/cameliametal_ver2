<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'employeeId' => ['required', 'string', 'min:12', 'max:12'],
            'employeeId' => [
                'required',
                'string',
                'min:12',
                'max:12',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'employeeId' => $input['employeeId'],
            'password' => Hash::make($input['password']),
            'api_token' => Str::random(80),
            'email_verified_at' => now()
        ]);

        $user->assignRole('user');

        return $user;
    }
}
