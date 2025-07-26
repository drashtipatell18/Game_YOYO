<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
class BlogController extends Controller
{
   public function blog()
   {
        $blogs = Blog::with('user')->get();
        return view('frontend.blog', compact('blogs'));
   }
}
