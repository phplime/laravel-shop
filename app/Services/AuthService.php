<?php

namespace App\Services;

use App\Jobs\SendWelcomeEmail;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthService
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }



    public function login(string $identifier, string $password, bool $remember = false)
    {
        $user = $this->userRepo->findByCredentials($identifier);
        if (!$user || !Hash::check($password, $user->password)) {
            throw new \Illuminate\Validation\ValidationException(
                validator([], []),
                response()->json(['message' => 'Invalid credentials'], 401)
            );
        }

        // Optional: Delete old tokens
        $user->tokens()->delete();

        $expiresAt = $remember ? now()->addDays(30) : now()->addDay();

        $token = $user->createToken('API Token', ['*'], $expiresAt)
            ->plainTextToken;

        return [
            'success' => true,
            'token' => $token,
            'user' => $user,
            'expires_at' => $expiresAt->toDateTimeString()
        ];
    }

    public function register(array $data)
    {
        $user = $this->userRepo->create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Dispatch background job to send welcome email
        // SendWelcomeEmail::dispatch($user);

        return [
            'user'  => $user,
            'token' => $user->createToken('API Token')->plainTextToken,
        ];
    }



    // In AuthService.php
    // In AuthService.php
    public function webLogin(string $identifier, string $password, bool $remember = false)
    {
        $user = $this->userRepo->findByCredentials($identifier);


        if (!$user || !Hash::check($password, $user->password)) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }



        // Session-based login for web
        Auth::login($user, $remember);

        return ['success' => true, 'user' => $user];
    }


    public function validateLogin(array $data)
    {
        $rules = [
            'identifier' => 'required|string',
            'password'   => 'required|string',
            'remember'   => 'nullable|boolean',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}
