<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['Login', 'LoginStore', 'logout']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function Login(){
        return view('auth.login');
    }

    public function LoginStore(Request $request)
    {
        // First check if user exists
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

        return redirect()->intended('dashboard')->with('success', 'Login successful!')->with('auth', $auth);
    }

    public function cPassword()
    {
        // Check if authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to change your password.');
        }

        $user = Auth::user();
        return view('auth.changepass', ['user' => $user]);
    }

    public function changePassword(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to change your password.');
        }

        $user = Auth::user();

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Password changed successfully.');
    }

  
    public function checkCurrentPassword(Request $request)
    {
        $user = Auth::user();
        $isValid = Hash::check($request->input('current_password'), $user->password);
        return response()->json(['valid' => $isValid]);
    }
}
