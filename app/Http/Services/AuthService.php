<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(string $email, string $password): array
    {
        $user = User::whereEmail($email)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'Incorrect email or password',
            ], 422));
        }

        return [
            'success'   => true,
            'type'      => 'Bearer',
            'access_token'     => $user->createToken('api')->plainTextToken,
            'user'      => $user,
        ];
    }
}
