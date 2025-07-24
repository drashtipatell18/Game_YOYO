<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembersSay;
class MembersSayController extends Controller
{
    //
    public function ViewMembersSay()
    {
        $membersSay = MembersSay::all();
        return view('members_say.view_members_say', compact('membersSay'));
    }
    public function CreateMembersSay()
    {
        return view('members_say.create_members_say');
    }
    public function StoreMembersSay(Request $request)
    {
        $imageName = '';
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/members_say'), $imageName);
        }
        MembersSay::create([
            'name' => $request->input('name'),
            'image' => $imageName,
            'description' => $request->input('description'),
        ]);
        return redirect()->route('members-say')->with('success', 'Members Say created successfully');
    }

    public function EditMembersSay($id)
    {
        $membersSay = MembersSay::find($id);
        return view('members_say.create_members_say', compact('membersSay'));
    }
    public function UpdateMembersSay(Request $request, $id)
    {
        $membersSay = MembersSay::find($id);
        $imageName = $membersSay->image;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/members_say'), $imageName);
        }
        $membersSay->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('members-say')->with('success', 'Members Say updated successfully');
    }

    public function DestroyMembersSay($id)
    {
        $membersSay = MembersSay::find($id);
        $membersSay->delete();
        return redirect()->route('members-say')->with('success', 'Members Say deleted successfully');
    }

}
