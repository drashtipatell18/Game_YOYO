<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reviews;

class ReviewController extends Controller
{
    public function reviews()
    {
        $reviews = Reviews::with(['product', 'user'])->get();
        return view('review.view_review',compact('reviews'));
    }

    public function create()
    {
        $products = Product::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        return view('review.create_review',compact('products','users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|min:5',
        ]);

        Reviews::create($validated);

        return redirect()->route('reviews')->with('success', 'Review created successfully.');
    }

    public function edit($id)
    {
        $review = Reviews::findOrFail($id);
        $products = Product::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view('review.create_review', compact('review', 'products', 'users'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|min:5',
        ]);

        $review = Reviews::findOrFail($id);
        $review->update($validated);

        return redirect()->route('reviews')->with('success', 'Review updated successfully.');
    }

    public function destroy($id)
    {
        $review = Reviews::findOrFail($id);
        $review->delete();

        return redirect()->route('reviews')->with('success', 'Review deleted successfully.');
    }
}
