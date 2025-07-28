<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddToCart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AddToCartController extends Controller
{
    public function AddToCart()
    {
        $carts = AddToCart::with(['product', 'user'])->get();
        return view('cart.view_cart', compact('carts'));
    }

    public function CreateAddToCart(Request $request)
    {
        $products = Product::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        return view('cart.create_cart', compact('products', 'users'));
    }

    public function StoreAddToCart(Request $request)
    {
        AddToCart::create([
            'user_id' => $request->input('user_id'), // Assuming user_id is passed in the request
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
        ]);

        return redirect()->route('add-to-cart')->with('success', 'Product added to cart successfully.');
    }

    public function EditAddToCart($id)
    {
        $cart = AddToCart::findOrFail($id);
        $products = Product::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        return view('cart.create_cart', compact('cart', 'products', 'users'));
    }
    public function updateCart(Request $request, $id)
    {
        $cart = AddToCart::find($id);
        $cart->update([
            'quantity' => $request->input('quantity'),
        ]);

        return redirect()->route('add-to-cart')->with('success', 'Product updated to cart successfully.');
    }

    public function DeleteAddToCart($id)
    {
        $cart = AddToCart::findOrFail($id);
        $cart->delete();

        return redirect()->route('add-to-cart')->with('success', 'Product removed from cart successfully.');
    }
    public function removeFromCart($id)
    {
        AddToCart::where('product_id', $id)->delete();
        return redirect()->back()->with('success', 'Product removed from cart successfully.');
    }
}
