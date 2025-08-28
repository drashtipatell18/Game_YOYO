<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Product;
use Stripe\PaymentIntent;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Models\AddToCart;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Mail\GameLinkMail;
use Illuminate\Support\Facades\Mail;

class StripePaymentController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::findOrFail($productId);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $product->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'metadata' => [
                'product_id' => $product->id,
            ],
            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.cancel'),
        ]);

        return response()->json(['url' => $session->url]);
    }




    public function success(Request $request)
    {
        $session_id = $request->get('session_id');
        if (!$session_id) {
            return redirect()->route('payment.cancel')->with('error', 'Invalid session.');
        }
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $session = Session::retrieve([
                'id' => $session_id,
                'expand' => ['line_items', 'payment_intent']
            ]);
            $payment_status = $session->payment_status;
            if ($payment_status !== 'paid') {
                return redirect()->route('payment.cancel')->with('error', 'Payment not completed.');
            }
            $product_id = $session->metadata->product_id ?? null;

            if (!$product_id) {
                return redirect()->route('payment.cancel')->with('error', 'Product info missing in session.');
            }
            $product = Product::find($product_id);
        
            if (!$product) {
                return redirect()->route('payment.cancel')->with('error', 'Product not found.');
            }
           
            Payment::create([
                'product_id' => $product->id,
                'user_id' => auth()->id() ?? null, 
                'price' => $product->price,
                'razorpay_payment_id' => $session->id,
                'payment_status' => 'completed',
                'payment_type' =>  $session->payment_method_types[0] ?? 'card',
            ]);
            return view('payment.success');

        } catch (\Exception $e) {
            \Log::error('Payment verification failed: ' . $e->getMessage());

            return redirect()->route('payment.cancel')->with('error', 'Payment verification failed.');
        }
    }

// Cart Payment

    public function getStripeSession($cartId)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $cartItems = AddToCart::where('user_id', auth()->id())->get();

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        if ($total < 1) {
            return response()->json([
                'error' => 'Order amount must be at least ₹1.'
            ], 400);
        }

        // Build line items for Stripe Checkout
        $lineItems = $cartItems->map(function ($item) {
            return [
                'price_data' => [
                    'currency' => 'usd', // Change if needed
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                    'unit_amount' => round($item->product->price * 100), // Amount in cents
                ],
                'quantity' => $item->quantity,
            ];
        })->toArray();

        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe.cancel', [], true),
                'metadata' => [
                    'user_id' => auth()->id(),
                    'cart_id' => $cartId,
                ],
            ]);

            return response()->json(['sessionId' => $session->id]);

        } catch (\Exception $e) {
            \Log::error('Stripe Session Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create session'], 500);
        }
    }




    public function getCartpaymentSuccessStripe(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $sessionId = $request->get('session_id');
        if (!$sessionId) {
            return redirect()->route('cart')->with('error', 'Missing session_id');
        }
        // Retrieve the session from Stripe
        try {
            $session = Session::retrieve($sessionId);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid session_id'], 400);
        }

        $paymentIntentId = $session->payment_intent ?? null;
        $paymentMethod = $session->payment_method_types[0] ?? 'unknown';
        $amountTotal = $session->amount_total / 100; 

        $cartItems = AddToCart::where('user_id', auth()->id())->get();
        $cartIds = $cartItems->pluck('id')->toArray();
        $cartIdsString = implode(',', $cartIds);

         $exeUrl = asset('storage/games/mygame.exe'); 
      

        // Save payment record
        $newPayment = Payment::create([
            'user_id' => auth()->id(),
            'cart_id' => $cartIdsString,
            'price' => $amountTotal,
            'razorpay_payment_id' => $paymentIntentId,
            'payment_status' => 'completed',
            'payment_type' => $paymentMethod,
        ]);

        // Clear cart
        AddToCart::where('user_id', auth()->id());
        
        $user = auth()->user();
        if ($user && $user->email) {
            Mail::to($user->email)->send(new GameLinkMail($exeUrl));
        }


         return redirect()->route('invoice.show', ['payment_id' => $newPayment->id])
                     ->with('success', 'Payment completed successfully!');
    }

    public function stripeCancel()
    {
        return view('payment.stripe_cancel');
    }

    public function cancel()
    {
        return view('payment.cancel');
    }
}
