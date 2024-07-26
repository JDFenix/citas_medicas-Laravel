<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function showSettings()
    {
        return view("user.settings");
    }

    public function showProfile()
    {
        $avatarUrls = $this->getAvatarsProfile();
        $pixelArtUrls = array_slice($avatarUrls, 0, 10);
        $avataaarsUrls = array_slice($avatarUrls, 10, 10);
        $adventurerUrls = array_slice($avatarUrls, 20, 10);

        return view("user.profile", compact('pixelArtUrls', 'avataaarsUrls', 'adventurerUrls'));
    }

    public function getAvatarsProfile()
    {
        $avatarUrls = [];
        $avatarTypes = ["pixel-art", "avataaars", "adventurer"];

        foreach ($avatarTypes as $type) {
            for ($i = 0; $i < 10; $i++) {
                $seedAvatar = Str::random(15);
                $avatarUrls[] = "https://api.dicebear.com/9.x/$type/svg?seed=$seedAvatar";
            }
        }

        return $avatarUrls;
    }
}
