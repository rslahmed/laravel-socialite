<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Socialite;

class LoginController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();
//        dd($socialUser);
//        $user = User::firstOrCreate([
//           'email' => $socialUser->email,
//        ], [
//            'name' => $socialUser->name,
//            'provider' => $provider,
//            'provider_id' => $socialUser->id,
//            'password' => Hash::make(Str::random(24))
//        ]);
        $user = User::where('email', $socialUser->email)->first();

        // if user already found
        if( $user ) {
            // update the avatar and provider that might have changed
            $user->update([
                'profile_photo_path' => $socialUser->avatar,
                'provider' => $provider,
                'provider_id' => $socialUser->id,
            ]);
        } else {
            // create a new user
            $user = User::create([
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'profile_photo_path' => $socialUser->avatar,
                'provider' => $provider,
                'provider_id' => $socialUser->id,
                'password' => Hash::make(Str::random(24))
            ]);
        }

        Auth::login($user, true);
        return redirect(route('dashboard'));
    }
}
