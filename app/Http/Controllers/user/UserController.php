<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function showProfile()
    {
        $avatarUrls = $this->getAvatarsProfile();
        $pixelArtUrls = array_slice($avatarUrls, 0, 10);
        $avataaarsUrls = array_slice($avatarUrls, 10, 10);
        $adventurerUrls = array_slice($avatarUrls, 20, 10);
        
        $user = Auth::user();
        $isExternalAuth = !empty($user->external_auth);
        $isPasswordSet = !empty($user->password);
    
        return view("user.profile", compact('pixelArtUrls', 'avataaarsUrls', 'adventurerUrls', 'isExternalAuth', 'isPasswordSet'));
    }
    

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
    
        $request->validate([
            'name' => 'required|string|max:255',
            'paternal_surname' => 'nullable|string|max:255',
            'maternal_surname' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'avatar' => 'nullable|url',
        ]);
    
        $user->update([
            'name' => $request->input('name'),
            'paternal_surname' => $request->input('paternal_surname'),
            'maternal_surname' => $request->input('maternal_surname'),
            'birth_date' => $request->input('birth_date'),
            'avatar' => $request->input('avatar'),
        ]);
    
        return redirect()->back()->with('status', 'Profile updated successfully!');
    }
    

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('status', 'Email actualizado correctamente');
    }


//Función de  la contraseña "modificar contraseñas y modificarlas"
public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8|confirmed',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        return redirect()->back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->back()->with('status', 'Contraseña actualizada correctamente');
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

    public function updateAvatar(Request $request)
    {

        $request->validate([
            'avatar' => 'required|url',
        ]);

        $user = Auth::user();
        $user->avatar = $request->avatar;
        $user->save();

        return redirect()->back()->with('status', 'Avatar actualizado correctamente');
    }

}