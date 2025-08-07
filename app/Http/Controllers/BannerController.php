<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
class BannerController extends Controller
{
     public function bannerCreate(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'link' => 'nullable',
            'image' => 'required|mimes:jpeg,png,jpg,gif,webp,avif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('images/banners'), $imageName);
        }

        $banner = Banner::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'link' => $request->link,
            'image' => $imageName,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Banner created successfully',
            'data' => $banner
        ]);

    }
}
