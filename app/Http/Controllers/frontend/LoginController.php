<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function login(){
        return view('frontend.login');
    }

    public function frontlogin(Request $request){
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'No account found with this email address',
            ])->onlyInput('email');
        }

        // Then check password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'The password you entered is incorrect',
            ])->onlyInput('email');
        }

        // If we get here, credentials are valid
        $auth = Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('index')->with('success', 'Login successful!')->with('auth', $auth);
    }

    public function frontlogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function forget(){
        return view('frontend.Frontend_change');
    }

    public function profile($id){
        $user = User::find($id);
        return view('frontend.profile', compact('user'));
    }

    public function updateProfile(Request $request,$id)
    {
        // Get the currently authenticated user
        $user = User::find($id);
        $imageName = $user->image;
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/users'), $imageName);
        }
        $user->update([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'mobile_number' => $request->input('mobile_number'),
            'favorite_game' => $request->input('favorite_game'),
            'gaming_platform' => $request->input('gaming_platform'),
            'country' => $request->input('country'),
            'image' => $imageName,

        ]);

        // Save the changes
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function frontregister(){
        return view('frontend.signup');
    }
}
