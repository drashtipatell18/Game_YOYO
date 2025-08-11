<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\OutTeam;
use App\Models\Product;
use App\Models\Banner;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;
class HomeController extends Controller
{
    public function index()
    {
        $now = Carbon::now('Asia/Kolkata');
        $todayStart = Carbon::today('Asia/Kolkata');
        $todayEnd = Carbon::today('Asia/Kolkata')->endOfDay();

        // Activate products whose release_date has passed
        $updatedCount = Product::where('status', 'inactive')
            ->where('release_date', '<=', $now)
            ->update(['status' => 'active']);

        $ourTeams = OutTeam::all();

        // Get upcoming products + today's scheduled products
        $upcomingProduct = Product::where(function($query) use ($now, $todayStart, $todayEnd) {
            // Future products that are inactive
            $query->where('status', 'inactive')
                ->where('release_date', '>', $now);
        })
        ->orWhere(function($query) use ($todayStart, $todayEnd, $now) {
            // Today's products (regardless of status) that haven't been released yet
            $query->whereBetween('release_date', [$todayStart, $todayEnd])
                ->where('release_date', '>', $now);
        })
        ->orderBy('release_date', 'asc')
        ->get();

        $banners = Banner::select('id', 'title', 'subtitle', 'link', 'image')->get();
        $banners = $banners->map(function ($banner) {
            $banner->image = url('images/banners/' . $banner->image);
            return $banner;
        });

        $featuteProducts = Product::with('category')->orderBy('created_at', 'desc')->get();

        return view('frontend.index', compact('ourTeams', 'featuteProducts', 'upcomingProduct', 'banners'));
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

    public function getProductJson(Request $request)
    {
        $query = Product::with('category:id,name') // eager load category
            ->select('id', 'category_id', 'SKU', 'tags', 'name', 'price', 'image', 'description', 'weight', 'dimensions');

        // Check for category filter
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

          if ($request->has('search') && trim($request->search) !== '') {
        $search = str_replace(['%', '_'], ['\%', '\_'], trim($request->search));
        $query->where('name', 'LIKE', "%{$search}%");
    }


        $products = $query->get();

        // Format each product
        foreach ($products as $product) {
            $product->image = asset('images/products/' . $product->image); // Full image URL
            $product->category_name = $product->category->name ?? 'Unknown'; // Add category name
            unset($product->category); // Clean up if not needed
        }

        return response()->json($products);
    }

    public function FrontendChatboat()
    {
        return view('frontend.chatboat');
    }

}
