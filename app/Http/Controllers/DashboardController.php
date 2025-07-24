<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Mail\ForgotPasswordMail;

class DashboardController extends Controller
{
    public function index(){
        $users = User::count();
        return view('dashboard',compact('users'));
    }

    public function showForgetPasswordForm()
    {
        return view('auth.forgetpass');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', '=', $request->email)->first();
       
        if (!empty($user)) {
            $user->remember_token = Str::random(40);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->route('forget.password')->with('success', 'Password reset link sent successfully.');

        }
    }

    public function reset($token)
    {
        $user = User::where('remember_token', '=', $token)->first();
        if (!empty($user)) {
            $data['user'] = $user;
            $data['token'] = $user->remember_token;
            return view('auth.reset', $data);
        }
    }

    public function postReset($token, Request $request)
    {
        $request->validate([
            'newpassword' => 'required|string|min:8',
            'confirmpassword' => 'required|string|min:8',
        ]);

        if ($request->newpassword !== $request->confirmpassword) {
            return redirect()->back()->with('error', 'The new password confirmation does not match.');
        }

        $user = User::where('remember_token', '=', $token)->first();
        if (!empty($user)) {
            if (empty($user->email_verified_at)) {
                $user->email_verified_at = now();
            }
            $user->remember_token = Str::random(40);
            $user->password = Hash::make($request->newpassword);
            $user->save();
            // return redirect('login')->with('success', 'Password successfully reset.');
            return redirect()->route('login')->with('success', 'Password successfully reset.');
        }
    }
}
