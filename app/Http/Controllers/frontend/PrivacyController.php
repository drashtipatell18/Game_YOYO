<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Privacy;

class PrivacyController extends Controller
{
    public function frontPrivacy()
    {
        $privacy = Privacy::all();
        return view('frontend.Privacy', compact('privacy'));
    }
}
