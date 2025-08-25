<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard() {
        $products = Product::all();
        return view('user.dashboard', compact('products'));
    }
}

