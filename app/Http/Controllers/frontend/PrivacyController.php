<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function frontPrivacy()
    {
        return view('frontend.Privacy');
    }
}
