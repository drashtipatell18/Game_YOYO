<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function service()
    {
        $services = Service::all();
        return view('frontend.services', compact('services'));
    }
}
