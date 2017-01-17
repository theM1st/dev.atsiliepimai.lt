<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Socialite;
use Auth;

class SocialAuthController extends Controller
{
    public function login($provider)
    {
        return Socialite::with($provider)->redirect();
    }

    public function facebookCallback()
    {
        $user = User::createOrGetSocialUser(Socialite::with('facebook')->user(), 'facebook');

        Auth::login($user, true);

        return redirect()->to('/');
    }

    public function googleCallback()
    {
        $user = User::createOrGetSocialUser(Socialite::with('google')->user(), 'google');

        Auth::login($user, true);

        return redirect()->to('/');
    }

    public function linkedinCallback()
    {
        $user = User::createOrGetSocialUser(Socialite::with('linkedin')->user(), 'linkedin');

        Auth::login($user, true);

        return redirect()->to('/');
    }
}
