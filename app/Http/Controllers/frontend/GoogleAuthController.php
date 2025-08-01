<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $findUser = User::where('google_id', $user->id)->first();

        if ($findUser) {
            Auth::login($findUser);
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => Hash::make('password'), // Default password, can be changed later
                'google_id' => $user->id,
                'role_id' => 2,  // default role id for users
            ]);

            Auth::login($newUser);
        }

        return redirect()->route('index');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver("facebook")->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            $facebookId = $facebookUser->getId();
            $email = $facebookUser->getEmail();
            $name = $facebookUser->getName();

            // Find existing user by facebook_id
            $user = User::where('facebook_id', $facebookId)->first();

            // If not found by facebook_id, try to find by email (optional)
            if (!$user && $email) {
                $user = User::where('email', $email)->first();
            }

            if (!$user) {
                $user = User::create([
                    'name' => $name ?? 'Facebook User',
                    'email' => $email ?? ('fb_user_' . $facebookId . '@example.com'), // fallback email
                    'facebook_id' => $facebookId,
                    'role_id' => 2,
                ]);
            }

            Auth::login($user);

            return redirect()->route('index')->with('success', 'Successfully logged in with Facebook!');
        } catch (\Exception $e) {
            \Log::error('Facebook login error: ' . $e->getMessage());
            return redirect()->route('index')->with('error', 'Something went wrong!');
        }
    }
    

}
