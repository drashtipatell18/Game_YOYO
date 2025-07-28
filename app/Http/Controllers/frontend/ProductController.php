<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

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

        return view('frontend.singleProduct',compact('product','images'));
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

}
