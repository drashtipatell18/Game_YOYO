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
        $product = Product::with(['category'])->findOrFail($id);

        // Get only first 2 reviews initially
        $initialReviews = $product->reviews()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        // Count total reviews
        $totalReviews = $product->reviews()->count();

        // Get related products
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(10)
            ->get();

        // Split images
        $images = !empty($product->image) ? explode(',', $product->image) : [];

        return view('frontend.singleProduct', compact(
            'product',
            'initialReviews',
            'totalReviews',
            'relatedProducts',
            'images'
        ));
    }

    public function loadMoreReviews(Request $request, $productId)
    {
        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 2);

        $reviews = Reviews::where('product_id', $productId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->skip($offset)
            ->take($limit)
            ->get();

        $totalReviews = Reviews::where('product_id', $productId)->count();
        $hasMore = ($offset + $limit) < $totalReviews;

        return response()->json([
            'reviews' => $reviews,
            'hasMore' => $hasMore,
            'totalReviews' => $totalReviews
        ]);
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
        $search = trim($request->input('search'));

        if (empty($search)) {
            return response()->json([
                'message' => 'Search term is required.'
            ], 400);
        }

        // Optional: escape % and _
        $escapedSearch = str_replace(['%', '_'], ['\%', '\_'], $search);

        $products = Product::with('category:id,name')
            ->select('id', 'category_id', 'SKU', 'tags', 'name', 'price', 'image', 'description', 'weight', 'dimensions')
            ->where('name', 'LIKE', "%{$escapedSearch}%")
            ->limit(10)
            ->get();



        // Format each product
        foreach ($products as $product) {
            $product->image = asset('images/products/' . $product->image);
            $product->category_name = $product->category->name ?? 'Unknown';
            unset($product->category);
        }

        return response()->json($products);
    }
}
