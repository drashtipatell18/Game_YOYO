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
        // Step 1: Get the payment record
        $payment = Payment::with('user')->findOrFail($payment_id);

        // Step 2: Extract cart item IDs from the string
        $cartIds = array_filter(array_map('trim', explode(',', $payment->cart_id)));

        // Step 3: Get cart items based on those IDs
        $cartItems = AddToCart::whereIn('id', $cartIds)->get();
       

        // Step 4: Get product IDs from those cart items
        $productIds = $cartItems->pluck('product_id')->unique();


        // Step 5: Retrieve the product details
        $products = Product::whereIn('id', $productIds)->get();

        AddToCart::where('user_id', auth()->id())->delete();

       

        // Step 6: Pass data to the view
        return view('frontend.invoice', compact('payment', 'cartItems', 'products'));
    }
}
