<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

class DeleteUserController extends Controller
{


    public function delete($cipherid)
    {
        $user = User::where('cipher_id', $cipherid)->first();
        $user->delete();
        return redirect('/home');
    }
}
