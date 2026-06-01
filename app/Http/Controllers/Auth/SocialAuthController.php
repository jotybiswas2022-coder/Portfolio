<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google and log them in.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Google authentication failed. Please try again.');
        }

        // Check if a user with this Google ID already exists
        $existingUser = User::where('google_id', $googleUser->getId())->first();

        if ($existingUser) {
            // Log the user in
            Auth::login($existingUser);
            return redirect()->intended('/');
        }

        // Check if a user with this email already exists (but without Google ID)
        $userByEmail = User::where('email', $googleUser->getEmail())->first();

        if ($userByEmail) {
            // Link the Google account to the existing user
            $userByEmail->update([
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ]);

            Auth::login($userByEmail);
            return redirect()->intended('/');
        }

        // Create a new user
        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'avatar' => $googleUser->getAvatar(),
            'password' => Hash::make(Str::random(16)), // Random password since login is via Google
        ]);

        Auth::login($user);
        return redirect()->intended('/');
    }
}
