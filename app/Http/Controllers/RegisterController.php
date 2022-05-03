<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:32',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|max:255|confirmed',
            'agree' => 'accepted'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        unset($validatedData['agree']);

        $user = User::create($validatedData);
        
        event(new Registered($user));

        return redirect('/login')->with('Success', 'User successfuly registered');
    }
}
