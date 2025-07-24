<?php

namespace App\Http\Controllers;

use App\Models\TopArticles;
use Illuminate\Http\Request;

class TopArticlesController extends Controller
{
    public function articles()
    {
        $articles = TopArticles::all();
        return view('articles.view_articles', compact('articles'));
    }

    public function create()
    {
        return view('articles.create_articles');
    }

    public function store(Request $request)
    {
        $ImageName = '';

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ImageName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/articles'), $ImageName);
        }
        TopArticles::create([
            'name' => $request->input('name'),
            'image' => $ImageName,
        ]);
        return redirect()->route('articles')->with('success', 'Articles created successfully');
    }

    public function edit($id)
    {
        $article = TopArticles::find($id);
        return view('articles.create_articles', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = TopArticles::findOrFail($id);
        $imageName = $article->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/articles'), $imageName);
        }

        $article->update([
            'name' => $request->input('name'),
            'image' => $imageName,
        ]);

        return redirect()->route('articles')->with('success', 'Article updated successfully.');
    }


    public function destroy($id)
    {
        $articles = TopArticles::find($id);
        $articles->delete();
        return redirect()->route('articles')->with('success', 'Articles deleted successfully');
    }

}
