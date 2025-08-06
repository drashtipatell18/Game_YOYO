<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\TopArticles;
class BlogController extends Controller
{
   public function blogfronted()
   {
        $blogs = Blog::with('user')->get();
        $topArticle = TopArticles::all();
        
        return view('frontend.blog', compact('blogs','topArticle'));
   }
}
