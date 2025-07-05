<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService 
{
    public function __construct()
    {
    }
    public function registerUser(array $validatedData){
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Create token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Optionally, attach token to user for resource
        $user->token = $token;

        return $user;
    }
    public function login(array $validatedData): array
    {
        $user = User::where('email', $validatedData['email'])->first();

        if (! $user || ! Hash::check($validatedData['password'], $user->password)) {
            return [
                'status' => false,
                'message' => "Wrong crenditals",
            ];
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'status' => true,
            'message' => "you have successfully logged in",
            'data' => [
                'user' => new UserResource($user),
                'token' => $token,
            ],
        ];
    }
}
