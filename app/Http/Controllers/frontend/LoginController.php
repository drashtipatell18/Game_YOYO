<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('frontend.login');
    }

    public function forget(){
        return view('frontend.Frontend_change');
    }

    public function profile(){
        return view('frontend.profile');
    }
}
