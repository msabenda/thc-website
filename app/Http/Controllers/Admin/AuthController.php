<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $key = Str::lower($request->email).'|'.$request->ip();

        // Check too many attempts
        if (RateLimiter::tooManyAttempts($key, 3)) {
            return back()->withErrors([
                'email' => 'Too many login attempts. Try again in 30 minutes.'
            ]);
        }

        // Attempt login with is_admin
        if (Auth::attempt(array_merge($request->only('email','password'), ['is_admin' => 1]))) {
            $request->session()->regenerate();
            RateLimiter::clear($key);
            return redirect()->route('admin.dashboard');
        }

        RateLimiter::hit($key, 1800); // lock 30 minutes after 3 failed attempts

        return back()->withErrors([
            'email' => 'Authentication failed.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
