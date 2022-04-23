<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        return redirect()->route('task.create')
            ->with('success', 'Logged In Successfully');
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check email
        $user = User::where('name', $fields['name'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return back()->with('error', 'Bad credentials');
        }

        return redirect()->route('task.create')
            ->with('success', 'Logged In Successfully');
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/user/login');
    }
}