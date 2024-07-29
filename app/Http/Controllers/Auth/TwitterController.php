<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TwitterController extends Controller
{

    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }


    public function handleTwitterCallback(Request $request)
    {

        $twitterUser = Socialite::driver('twitter')->user();

        $user = User::where('external_id', $twitterUser->id)
            ->where('external_auth', 'twitter')
            ->first();

        if ($user) {

            Auth::login($user);
        } else {
            $user = User::create([
                'name' => $twitterUser->name,
                'email' => $twitterUser->email,
                'avatar' => $twitterUser->avatar,
                'external_id' => $twitterUser->id,
                'external_auth' => 'Twitter',
            ]);

            Auth::login($user);
        }

        return redirect('/home');
    }
}
