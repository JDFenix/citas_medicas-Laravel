<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClinicController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');


//appointments
Route::get("/appointment/register", [AppointmentController::class, 'create'])->name("appointment.formRegister")->middleware("auth");


//clinics
Route::get("/clinic", [ClinicController::class, 'index'])->name("clinic.showIndex")->middleware("auth");
Route::get("/clinic/registerF", [ClinicController::class, 'create'])->name("clinic.showCreate")->middleware("auth");
Route::post("/clinic/register", [ClinicController::class, 'store'])->name("clinic.post")->middleware("auth");

//clinic update/delete

Route::post('/clinic/update', [ClinicController::class, 'update'])->name('clinic.update');
Route::post('/clinic/get/{cipherid}', [ClinicController::class, 'edit'])->name('clinic.getClinic');
Route::delete('/clinic/get/{cipherid}', [ClinicController::class, 'delete'])->name('clinic.deleteClinic');


//google

Route::get('login-google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('google-callback', function () {
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
            'external_auth' => 'google',
        ]);

        Auth::login($user);
    }

    return redirect('/home');
});
