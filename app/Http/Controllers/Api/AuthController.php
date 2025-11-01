<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        try {
            $validated = $this->authService->validateLogin($request->all());
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors'  => $e->errors(),
            ], 422);
        }

        $result = $this->authService->login(
            $validated['identifier'],
            $validated['password'],
            $validated['remember'] ?? false
        );

        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'message' => $result['message']
            ], 401);
        }

        return response()->json([
            'success' => true,
            'access_token' => $result['token'],
            'token_type' => 'Bearer',
            'user' => $result['user'],
            'expires_at' => $result['expires_at'] ?? null
        ], 200);
    }



    public function weblogin(Request $request)
    {

        try {
            $validated = $this->authService->validateLogin($request->all());
        } catch (ValidationException $e) {
            return __request(0, 'error_text', '');
        }


        $result = $this->authService->webLogin(
            $validated['identifier'],
            $validated['password'],
            $validated['remember'] ?? false
        );

        if (!$result['success']) {
            return __request(0, $result['message'], '');
        }

        $request->session()->regenerate();

        return __request(1, "Login successfull", url("admin/dashboard"));
    }



    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = $this->authService->register($validated);

        return response()->json(['user' => $user, 'message' => 'Registered successfully!']);
    }


    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    // ✅ Logout (revoke token)
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
