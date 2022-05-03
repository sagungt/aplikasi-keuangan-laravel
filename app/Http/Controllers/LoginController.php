<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'password' => 'required',
        ]);

        $remember = $request->has('remember') ? true : false;

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()
                ->intended('/dashboard')
                ->with('Success', 'Login Success!');
        }

        return back()->with('loginError', 'Login failed. Invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::logoutCurrentDevice();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('Success', 'Logged out');
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

    public function requestPassword()
    {
        if (Auth::check()) {
            if (auth()->user()->hasVerifiedEmail()) redirect('dashboard');
        }
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email:dns']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['Success' => __($status)])
            : back()->with(['Error' => __($status)]);
    }

    public function resetPassword($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8|max:255|confirmed',
        ]);

        $status = Password::reset(
            $request->only('password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));
        
                    $user->save();
        
                    event(new PasswordReset($user));
                }
        );
     
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('Success', __($status))
            : back()->with('Error', __($status));
    }
}
