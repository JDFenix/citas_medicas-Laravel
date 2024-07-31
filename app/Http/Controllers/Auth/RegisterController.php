<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'avatar' => isset($data['avatar']) && $data['avatar'] !== null
                ? $data['avatar'] : "https://api.dicebear.com/9.x/open-peeps/svg?seed=" . Hash::make($data['name']) . Hash::make($data['email']),
            'name' => $data['name'],
            'paternal_surname' => $data['paternal_surname'],
            'maternal_surname' => $data['paternal_surname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'external_auth' => "Normal",
            'role' => "pacient",
            'status_code' => "disabled",
            'mobile_phone' => $data['mobile_phone'],
            'date_birth' => $data['date_birth'],
            
        ]);
    }
}
