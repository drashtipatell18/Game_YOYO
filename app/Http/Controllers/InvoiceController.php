<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\AddToCart;
use App\Models\Product;

class InvoiceController extends Controller
{
    public function invoice($payment_id)
    {
        $payment = Payment::with('user')->findOrFail($payment_id);
        $cartIds = array_filter(array_map('trim', explode(',', $payment->cart_id)));
        $cartItems = AddToCart::with('product')->whereIn('id', $cartIds)->get();
        $platform = request()->input('platform'); // 'android', 'ios', or null

        $cartItems->transform(function ($item) use ($platform) {
            $product = $item->product;

            // Set price based on platform
            if ($platform === 'android' && $product->android_price) {
                $price = $product->android_price;
            } elseif ($platform === 'ios' && $product->ios_price) {
                $price = $product->ios_price;
            } else {
                $price = $product->price ?? 0;
            }

            $item->final_price = $price; // add final_price property
            return $item;
        });

        return view('frontend.invoice', compact('payment', 'cartItems', 'platform'));
    }

}
