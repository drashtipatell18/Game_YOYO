<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function ViewUsers()
    {
        $users = User::with('role')->get();
        return view('users.view_users', compact('users'));
    }

    public function createUser()
    {
        $roles = Role::pluck('name', 'id');
        return view('users.create_user', compact('roles'));
    }

    public function storeUser(Request $request)
    {
        $imageName = "";
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/users'), $imageName);
        }
        User::create([
            'role_id' => $request->input('role_id'),
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
            'favourite_game' => $request->input('favourite_game'),
            'gaming_platform' => $request->input('gaming_platform'),
            'country' => $request->input('country'),
            'image' => $imageName,
        ]);
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'id');
        return view('users.create_user', compact('user', 'roles'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $imageName = $user->image;
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/users'), $imageName);
        }
        $user->update([
            'role_id' => $request->input('role_id'),
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
            'favourite_game' => $request->input('favourite_game'),
            'gaming_platform' => $request->input('gaming_platform'),
            'country' => $request->input('country'),
            'image' => $imageName,
        ]);
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroyUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
