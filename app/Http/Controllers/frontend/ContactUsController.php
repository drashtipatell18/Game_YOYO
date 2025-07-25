<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function contactus()
    {
        return view('frontend.Contact_us');
    }

    public function contactusStore(Request $request)
    {
        ContactUs::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'tag' => $request->input('tag'),
            'message' => $request->input('message'),
        ]);
        return response()->json(['success' => 'Your message has been sent successfully!']);
    }
}
