<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()
                ->intended('/dashboard')
                ->with('Success', 'Login Success!');
        }

        return back()->with('loginError', 'Login failed. Invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function verify()
    {
        return (auth()->user()->hasVerifiedEmail())
            ? redirect('dashboard')
            : view('auth.verify');
    }

    public function resend(Request $request)
    {
        $request
            ->user()
            ->sendEmailVerificationNotification();
        return back()
            ->with('Success', 'Verification link sent!');
    }

    public function verification(EmailVerificationRequest $request)
    {
        $request->fulfill();
        
        return redirect('/dashboard');
    }
}
