<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    public function dashboard()
    {
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'photo'=>'required|image',
            'category'=>'required',
            'price'=>'required|numeric',
            'whatsapp_link'=>'required'
        ]);

        $path = $request->file('photo')->store('products','public');

        Product::create([
            'name'=>$request->name,
            'photo'=>$path,
            'category'=>$request->category,
            'price'=>$request->price,
            'whatsapp_link'=>$request->whatsapp_link,
        ]);

        return back()->with('success','Produk berhasil ditambahkan');
    }
}
