<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\OutTeam;
use App\Models\Product;
use App\Models\Banner;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {    
        $ourTeams = OutTeam::all();
        // $upcomingProduct = Product::where('status', 'inactive')->get();
        $upcomingProduct = Product::where('status', 'inactive')
        ->where('release_date', '>', Carbon::now())
        ->get();
        $banners = Banner::select('id', 'title', 'subtitle', 'link', 'image')->get();
        $banners = $banners->map(function ($banner) {
            $banner->image = url('images/banners/' . $banner->image);
            return $banner;
        });
        
        $featuteProducts = Product::with('category')->orderBy('created_at', 'desc')->get();
        return view('frontend.index',compact('ourTeams', 'featuteProducts','upcomingProduct','banners'));
    }

    public function getCategoriesJson()
    {
        $categories = Category::select('id','name', 'image', 'icon')->get();

        foreach ($categories as $category) {
            $category->image = asset('images/category/' . $category->image); // Converts to full URL
            $category->icon = asset('images/category/' . $category->icon);
        }

        return response()->json($categories);
    }

    public function getProductJson()
    {
        $products = Product::with('category:id,name') // eager load category with only id & name
            ->select('id', 'category_id', 'SKU', 'tags', 'name', 'price', 'image', 'description', 'weight', 'dimensions')
            ->get();

        foreach ($products as $product) {
            $product->image = asset('images/products/' . $product->image); // Full URL for image
            $product->category_name = $product->category->name ?? 'Unknown'; // Add category name
            unset($product->category); // Optional: remove raw relationship data if not needed
        }

        return response()->json($products);
    }

}
