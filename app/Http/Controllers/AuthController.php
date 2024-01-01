<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Authentication successful
            auth()->login($user);
            return redirect()->route('dashboard')->with('success', 'Welcome back!');
        }

        // Authentication failed
        return redirect()->route('login')->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
