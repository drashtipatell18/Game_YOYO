<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;
class ContactUsController extends Controller
{
    public function contactUs()
    {
        $contacts = ContactUs::latest()->get();
        return view('contact_us.view_contact', compact('contacts'));
    }

    public function deleteContactUs($id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact->delete();
        return redirect()->back()->with('success', 'Contact deleted successfully');
    }
}
