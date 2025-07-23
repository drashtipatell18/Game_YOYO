<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OutTeam;

class OurTeamController extends Controller
{
    public function create(){
        return view('our_teams.create_teams');
    }
    public  function ourTeams()
    {
        $ourTeams = OutTeam::all();
        return view('our_teams.view_teams',compact('ourTeams'));
    }

    public function store(Request $request)
    {
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/ourteam'), $imageName);
        }

        OutTeam::create([
            'name' => $request->input('name'),
            'image' => $imageName,
            'designation' => $request->input('designation'),
        ]);

        return redirect()->route('our_teams')->with('success', 'Our Teams created successfully');
    }
    public function edit($id)
    {
        $ourTeams = OutTeam::findOrFail($id);
        return view('our_teams.create_teams', compact('ourTeams'));
    }
    public function update(Request $request, $id)
    {
        $ourTeams = OutTeam::findOrFail($id);
        $imageName = $ourTeams->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/ourteam'), $imageName);
        }

        $updateData = [
            'name' => $request->input('name'),
            'image' => $imageName,
            'designation' => $request->input('designation'),
        ];

        $ourTeams->update($updateData);

        return redirect()->route('our_teams')->with('success', 'Our Teams updated successfully');
    }


    public function destroy($id)
    {
        $ourTeams = OutTeam::findOrFail($id);
        $ourTeams->delete();

        return redirect()->route('our_teams')->with('danger', 'Our Teams deleted successfully.');
    }
}
