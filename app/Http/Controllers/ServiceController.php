<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function ViewService()
    {
        $service = Service::all();
        return view('service.view_service', compact('service'));
    }

    public function CreateService()
    {
        return view('service.create_service');
    }

    public function StoreService(Request $request)
    {
        $IconName = '';

        if($request->hasFile('icon')){
            $file = $request->file('icon');
            $IconName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/services'), $IconName);
        }
        Service::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'icon' => $IconName,
        ]);
        return redirect()->route('service')->with('success', 'Service created successfully');
    }

    public function EditService($id)
    {
        $service = Service::find($id);
        return view('service.create_service', compact('service'));
    }

    public function UpdateService(Request $request, $id)
    {
        $service = Service::find($id);
        $IconName = $service->icon;
        if($request->hasFile('icon')){
            $file = $request->file('icon');
            $IconName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/services'), $IconName);
        }
        $service->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'icon' => $request->input('icon'),
        ]);
        return redirect()->route('service')->with('success', 'Service updated successfully');
    }

    public function DestroyService($id)
    {
        $service = Service::find($id);
        $service->delete();
        return redirect()->route('service')->with('success', 'Service deleted successfully');
    }

}
