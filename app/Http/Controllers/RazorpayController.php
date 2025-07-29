<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Payment;
use Razorpay\Api\Api;
use App\Models\AddToCart;
use Illuminate\Support\Str;

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

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($request->razorpay_payment_id);
        $paymentType = $payment->method ?? 'unknown';

        // Store payment details in DB
        Payment::create([
            'product_id' => $product->id,
            'user_id' => auth()->id() ?? null, 
            'price' => $product->price,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'payment_status' => 'completed',
            'payment_type' => $paymentType,
        ]);

        return response()->json(['status' => 'success']);
    }


// Add To Cart

    public function getCartPaymentDetails($cartId)
    {
        $cartItems = AddToCart::where('user_id', auth()->id())->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt'         => 'cart_' . Str::random(10),
            'amount'          => round($total * 100), // amount in paise
            'currency'        => 'INR',
            'payment_capture' => 1
        ]);

        return response()->json([
            'razorpay_order_id' => $order['id'],
            'name' => 'Your Store',
            'description' => 'Cart Payment',
            'image' => asset('logo.png'), // optional
        ]);
    }

    public function getCartpaymentSuccess(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($request->razorpay_payment_id);
        $paymentType = $payment->method ?? 'unknown';


        Payment::create([
            'user_id' => auth()->id(),
            'cart_id' => $request->cart_id,
            'price' => $request->amount,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_order_id' => $request->razorpay_order_id,
            'payment_status' => 'completed',
            'payment_type' => $paymentType,
        ]);

        return response()->json(['status' => 'success']);
    }







}
