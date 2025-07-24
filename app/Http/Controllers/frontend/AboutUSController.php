<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUSController extends Controller
{
    public function aboutus()
    {
        return view('frontend.About_us');
    }
}
