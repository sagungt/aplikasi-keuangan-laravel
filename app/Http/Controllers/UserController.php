<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $users = $users->map(function ($user, $key) {
            $user['encrypted_id'] = encrypt($user->id);
            return $user;
        });
        return view('dashboard.admin.users', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return 'dashboard.user.create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:32',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|max:255|confirmed',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);
        event(new Registered($user));
        return view('dashboard.admin.users')->with('Success', 'User successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        return view('dashboard.user.show', [
            'user' => User::findOrFail(decrypt($user)),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // return 'dashboard.user.edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $decryptedUser = User::find(decrypt($user));
        $validatedData = $request->validate([
            'name' => 'required|max:32',
            'password' => 'required|min:8|max:255|confirmed',
            'current_password' => 'required',
        ]);

        $credentials = [
            'email' => $decryptedUser->email,
            'password' => $validatedData['current_password'],
        ];

        unset($validatedData['current_password']);
        $validatedData['password'] = bcrypt($validatedData['password']);

        if (Auth::attempt($credentials)) {
            User::where('id', decrypt($user))
                ->update($validatedData);
            return back()->with('Success', 'Users updated');
        }
        return back()->with('Error', 'Wrong credentials');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        User::destroy(decrypt($user));
        return redirect('dashboard')->with('Success', 'User has been deleted');
    }
}
