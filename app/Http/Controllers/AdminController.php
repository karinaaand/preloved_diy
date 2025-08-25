<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    }

    public function store(Request $request) {
        Product::create($request->all());
        return back();
    }
}
