<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function addToCart(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "product" => $product
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produkt dodany do koszyka!');
    }

    public function removeFromCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produkt usunięty z koszyka!');
    }

    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Produkt nie istnieje.');
        }

        if(isset($cart[$id])) {
            if ($request->quantity > $product->stock) {
                return redirect()->back()->with('error', "Niestety, mamy tylko {$product->stock} szt. produktu {$product->name} na magazynie.");
            }

            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Koszyk zaktualizowany!');
        }

        return redirect()->back();
    }

    public function checkout()
    {
        session()->forget('cart');
        return view('cart.checkout');
    }
}
