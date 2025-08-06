<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Reviews;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ProductController extends Controller
{
    public function allProducts()
    {
        return view('frontend.allProduct');
    }

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        $images = explode(',', $product->image);
        $reviewCount = $product->reviews()->count();

        $relatedProducts = Product::where('category_id', $product->category_id)
                              ->where('id', '!=', $product->id)
                              ->take(10)
                              ->get();

                            // dd($relatedProducts);


        return view('frontend.singleProduct',compact('product','images','reviewCount','relatedProducts'));
    }

    public function getproductDetailJson($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $category = Category::where('name', $product->category_name)->first();
        $categoryId = $category ? $category->id : null;

        return response()->json([
            'id' => $product->id,
            'title' => $product->title,
            'price' => $product->price,
            'description' => $product->description,
            'image' => $product->image,
            'category_name' => $product->category_name,
            'category_id' => $categoryId,
            'tags' => $product->tags, // Make sure this is cast to array if stored as JSON
            'weight' => $product->weight,
            'dimensions' => $product->dimensions,
        ]);
    }

    public function storeReviewProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:500',
        ]);

        $review = new Reviews();
        $review->product_id = $request->product_id;
        $review->user_id = Auth::id();
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->save();

        return response()->json(['message' => 'Review submitted successfully'], 201);
    }

    public function search(Request $request)
    {
        $query = trim($request->input('search'));
        $escapedQuery = str_replace(['%', '_'], ['\%', '\_'], $query);

    $suggestions = Product::whereRaw('name LIKE ?', ["%{$escapedQuery}%"])
            ->select('id', 'name')
            ->limit(10) // Add limit for better performance
            ->get();
        return response()->json($suggestions);
    }
}
