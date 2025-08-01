<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Privacy;

class PrivacyController extends Controller
{
    public function ViewPrivacy()
    {
        $privacy = Privacy::all();
        return view('privacy.view_privacy', compact('privacy'));
    }

    public function CreatePrivacy()
    {
        return view('privacy.create_privacy');
    }

    public function StorePrivacy(Request $request)
    {
        Privacy::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('privacy')->with('success', 'Privacy created successfully');
    }

    public function EditPrivacy($id)
    {
        $privacy = Privacy::find($id);
        return view('privacy.create_privacy', compact('privacy'));
    }

    public function UpdatePrivacy(Request $request, $id)
    {
        $privacy = Privacy::find($id);
        $privacy->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('privacy')->with('success', 'Privacy updated successfully');
    }

    public function DestroyPrivacy($id)
    {
        $privacy = Privacy::find($id);
        $privacy->delete();
        return redirect()->route('privacy')->with('success', 'Privacy deleted successfully');
    }


    public function shipmentPolicy()
    {
        return view('frontend.shippment_policy');
    }

    public function termsConditions()
    {
        return view('frontend.terms_conditions');
    }

    public function cancelRefunds()
    {
        return view('frontend.cancel_refund');
    }
}
