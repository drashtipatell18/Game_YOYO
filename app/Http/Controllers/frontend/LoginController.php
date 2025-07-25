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

    public function profile(){
        return view('frontend.profile');
    }
}
