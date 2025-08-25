<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'role'=>'user'
        ]);

        return redirect('/login')->with('success','Register berhasil, silakan login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email','password'))) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }
            return redirect('/user/dashboard');
        }
        return back()->withErrors(['email'=>'Email atau password salah']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
