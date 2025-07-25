<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembersSay;

class AboutUSController extends Controller
{
    public function aboutus()
    {
        $membersSay = MembersSay::all();
        return view('frontend.About_us', compact('membersSay'));
    }
}
