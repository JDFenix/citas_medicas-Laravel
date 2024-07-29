<?php

namespace App\Http\Controllers\Auth;


use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GoogleController extends Controller
{



    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callbackGoogle()
    {
        $socialUser = Socialite::driver('google')->user();
        $user = User::where('external_id', $socialUser->id)
            ->where('external_auth', 'google')
            ->first();

        if ($user) {
            Auth::login($user);
        } else {
            $user = User::create([
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'avatar' => $socialUser->avatar,
                'external_id' => $socialUser->id,
                'external_auth' => 'Google',
            ]);

            Auth::login($user);
        }

        return redirect('/home');
    }




    
}
