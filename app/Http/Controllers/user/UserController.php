<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function showSettings()
    {
        return view("user.settings");
    }

    public function showProfile()
    {
        return view("user.profile");
    }

}
