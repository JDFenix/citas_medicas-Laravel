<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClinicController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\lang\LanguageController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Auth\TwitterController;
use App\Http\Controllers\Auth\GoogleController;

Route::get('/', function () {
    return view('home');
});
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');


//appointments
Route::get("/appointment/register", [AppointmentController::class, 'create'])->name("appointment.formRegister")->middleware("auth");
Route::post("/appointment/registerP", [AppointmentController::class, 'store'])->name("appointment.post")->middleware("auth");
Route::get("/appointment/main", [AppointmentController::class, 'index'])->name("appointment.main")->middleware("auth");
Route::get("/appointment/{id}", [AppointmentController::class, 'show'])->name("appointment.show")->middleware("auth");
Route::get("/appointment/{id}/edit", [AppointmentController::class, 'edit'])->name("appointment.edit")->middleware("auth");
Route::put("/appointment/{id}", [AppointmentController::class, 'update'])->name("appointment.update")->middleware("auth");
Route::delete("/appointment/{id}", [AppointmentController::class, 'destroy'])->name("appointment.destroy")->middleware("auth");


// Doctor
Route::get('/doctor/main', [DoctorController::class, 'index'])->name('doctor.main');
Route::get('/doctor/register', [DoctorController::class, 'create'])->name('doctor.formRegister');
Route::post('/doctor/store', [DoctorController::class, 'store'])->name('doctor.store');
Route::get('/doctor/{id}/edit', [DoctorController::class, 'edit'])->name('doctor.edit');
Route::put('/doctor/{id}', [DoctorController::class, 'update'])->name('doctor.update')->middleware('auth');
Route::delete('/doctor/{id}', [DoctorController::class, 'destroy'])->name('doctor.destroy');



//clinics
Route::get("/clinic", [ClinicController::class, 'index'])->name("clinic.showIndex")->middleware("auth");
Route::get("/clinic/registerF", [ClinicController::class, 'create'])->name("clinic.showCreate")->middleware("auth");
Route::post("/clinic/register", [ClinicController::class, 'store'])->name("clinic.post")->middleware("auth");

//clinic update/delete

Route::post('/clinic/update', [ClinicController::class, 'update'])->name('clinic.update')->middleware("auth");
Route::post('/clinic/get/{cipherid}', [ClinicController::class, 'edit'])->name('clinic.getClinic')->middleware("auth");
Route::delete('/clinic/get/{cipherid}', [ClinicController::class, 'delete'])->name('clinic.deleteClinic')->middleware("auth");

///////////////// Services Oauth2
//google
Route::get('login-google', [GoogleController::class, 'redirectToGoogle']);
Route::get('google-callback', [GoogleCOntroller::class, 'callbackGoogle']);


// X
Route::get('auth/twitter', [TwitterController::class, 'redirectToTwitter']);
Route::get('auth/twitter/callback', [TwitterController::class, 'handleTwitterCallback']);


//change language
Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');


//user
Route::get('/user/profile', [UserController::class,"showProfile"])->name('user.showProfile')->middleware("auth")->middleware("auth");

Route::get('user/settings', [UserController::class,"showSettings"])->name('user.showSetting')->middleware("auth")->middleware("auth");

