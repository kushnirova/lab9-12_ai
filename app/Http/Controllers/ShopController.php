<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::all();
        return view('shop.index', compact('products'));
    }
}
