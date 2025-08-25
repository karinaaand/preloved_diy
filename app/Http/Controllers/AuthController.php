<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegister() { return view('auth.register'); }
    public function register(Request $request) {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);
        return redirect('/login');
    }

    public function showLogin() { return view('auth.login'); }
    public function login(Request $request) {
        if (Auth::attempt($request->only('email','password'))) {
            if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard');
            }
            return redirect('/user/dashboard');
        }
        return back()->with('error','Login gagal');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
