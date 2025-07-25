<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\OutTeam;

class HomeController extends Controller
{
    public function index()
    {
        $ourTeams = OutTeam::all();
        return view('frontend.index',compact('ourTeams'));
    }

    public function getCategoriesJson()
    {
        $categories = Category::select('name', 'image', 'icon')->get();

        foreach ($categories as $category) {
            $category->image = asset('images/category/' . $category->image); // Converts to full URL
            $category->icon = asset('images/category/' . $category->icon); 
        }

        return response()->json($categories);
    }
}
