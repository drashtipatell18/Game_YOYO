<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create(){
        return view('category.create_category');
    }
    public  function category()
    {
        $categories=Category::all();
        return view('category.view_category',compact('categories'));
    }

    public function store(Request $request)
    {
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/category'), $imageName);
        }

        $iconName = null;
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = time() . '_' . uniqid() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('images/category'), $iconName);
        }

        Category::create([
            'name' => $request->input('name'),
            'image' => $imageName,
            'icon' => $iconName,
        ]);

        return redirect()->route('category')->with('success', 'Category created successfully');
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.create_category', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $imageName = $category->image;
        $iconName = $category->icon;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/category'), $imageName);
        }
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = time() . '_' . uniqid() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('images/category'), $iconName);
        }

        $updateData = [
            'name' => $request->input('name'),
            'image' => $imageName,
            'icon' => $iconName,
        ];

        $category->update($updateData);

        return redirect()->route('category')->with('success', 'Category updated successfully');
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category')->with('danger', 'Category deleted successfully.');
    }

}
