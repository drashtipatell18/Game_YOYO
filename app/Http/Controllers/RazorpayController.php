<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Payment;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    public function getPaymentDetails($productId)
    {
        $product = Product::findOrFail($productId);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt' => 'rcpt_' . uniqid(),
            'amount' => $product->price * 100, // in paise
            'currency' => 'INR',
        ]);

        return response()->json([
            'razorpay_order_id' => $order->id,
            'amount' => $product->price,
            'name' => $product->title,
            'description' => $product->description,
            'image' => '/images/products/' . explode(',', $product->image)[0] ?? ''
        ]);
    }

    public function paymentSuccess(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id' => 'required|string',
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::find($request->product_id);

        // Store payment details in DB
        Payment::create([
            'product_id' => $product->id,
            'user_id' => auth()->id() ?? null, // Optional, if you use login
            'price' => $product->price,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'payment_status' => 'completed',
        ]);

        return response()->json(['status' => 'success']);
    }
}
