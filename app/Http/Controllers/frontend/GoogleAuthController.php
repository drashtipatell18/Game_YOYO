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

            // Check if user already exists
            $user = User::where('facebook_id', $facebookUser->getId())->first();

            if (!$user) {
                // Create new user
                $user = User::create([
                    'name' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                    'facebook_id' => $facebookUser->getId(),
                     'role_id' => 2,
                ]);
            }

            // Log in the user
            Auth::login($user);

            return redirect()->route('index')->with('success', 'Successfully logged in with Facebook!');

        } catch (\Exception $e) {
            return redirect()->route('index')->with('error', 'Something went wrong!');
        }
    }

}
