<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            if ($request->expectsJson()) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        if (!$request->expectsJson()) {
            auth()->login($user);
            return redirect('/');
        }

        return response()->json([
            'token' => $user->createToken($request->device_name ?? 'web')->plainTextToken,
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        if ($request->expectsJson()) {
            $request->user()->currentAccessToken()->delete();
        } else {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return $request->expectsJson() 
            ? response()->json(['message' => 'Logged out successfully'])
            : redirect('/login');
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
