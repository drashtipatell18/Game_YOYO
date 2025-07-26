<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function allProducts()
    {
        return view('frontend.allProduct');
    }

    public function productDetails()
    {
        return view('frontend.singleProduct');
    }
}
