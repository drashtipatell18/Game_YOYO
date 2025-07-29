<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\AddToCart;
class CartController extends Controller
{
    public function Cart(){
       $userId = Auth::id(); // Get authenticated user ID

    if (!$userId) {
        return view('frontend.cart', ['carts' => collect(), 'cartTotal' => 0]);
    }

    $carts = AddToCart::with(['product.category', 'user'])
                     ->where('user_id', $userId)
                     ->get();
    // Calculate total
    $cartTotal = $carts->sum(function($cart) {
        return $cart->product ? $cart->product->price : 0;
    });

    return view('frontend.cart', compact('carts', 'cartTotal'));

    }
    public function FrontaddToCart(Request $request)
    {
        try {
            // Check if user is authenticated
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to add items to cart'
                ], 401);
            }

            $request->validate([
                'product_id' => 'required|exists:products,id'
            ]);

            $userId = Auth::id();
            $productId = $request->product_id;

            // Get product details
            $product = Product::find($productId);
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            // Check if item already exists in cart
            $existingCartItem = AddToCart::where('user_id', $userId)
                                  ->where('product_id', $productId)
                                  ->first();

            if ($existingCartItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product already in cart'
                ]);
            } else {
                // Create new cart item
                AddToCart::create([
                    'user_id' => $userId,
                    'product_id' => $productId
                ]);

                $message = 'Product added to cart successfully';
            }

            // Get updated cart count
            $cartCount = AddToCart::where('user_id', $userId)->count();

            return response()->json([
                'success' => true,
                'message' => $message,
                'cart_count' => $cartCount
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding product to cart: ' . $e->getMessage()
            ], 500);
        }
    }

    public function FrontgetCartItems()
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to view cart'
            ], 401);
        }

        $cartItems = AddToCart::with('product')
                        ->where('user_id', Auth::id())
                        ->get();

        $total = $cartItems->sum(function($item) {
            return $item->product ? $item->product->price : 0;
        });

        return response()->json([
            'success' => true,
            'cart_items' => $cartItems,
            'total' => $total,
            'count' => $cartItems->count()
        ]);
    }
    public function getCartApi(){
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $carts = AddToCart::with(['product.category', 'user'])
                        ->where('user_id', $userId)
                        ->get();

        $cartTotal = $carts->sum(function($cart) {
            return $cart->product ? $cart->product->price : 0;
        });

        return response()->json([
            'carts' => $carts,
            'total' => $cartTotal
        ]);
    }

    public function removeFromCart($id){
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $cartItem = AddToCart::where('id', $id)
                            ->where('user_id', $userId)
                            ->first();

        if (!$cartItem) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        $cartItem->delete();

        return response()->json(['message' => 'Item removed successfully']);
    }
}
