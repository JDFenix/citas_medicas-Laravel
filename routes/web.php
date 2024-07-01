<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClinicController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\DeleteUserController;
use App\Http\Controllers\lang\LanguageController;
use App\Http\Controllers\user\UserController;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');


//appointments
Route::get("/appointment/register", [AppointmentController::class, 'create'])->name("appointment.formRegister")->middleware("auth");
Route::post("/appointment/registerP", [AppointmentController::class, 'store'])->name("appointment.post")->middleware("auth");
Route::get("/appointment/main", [AppointmentController::class, 'index'])->name("appointment.main")->middleware("auth");


//clinics
Route::get("/clinic", [ClinicController::class, 'index'])->name("clinic.showIndex")->middleware("auth");
Route::get("/clinic/registerF", [ClinicController::class, 'create'])->name("clinic.showCreate")->middleware("auth");
Route::post("/clinic/register", [ClinicController::class, 'store'])->name("clinic.post")->middleware("auth");

//clinic update/delete

Route::post('/clinic/update', [ClinicController::class, 'update'])->name('clinic.update');
Route::post('/clinic/get/{cipherid}', [ClinicController::class, 'edit'])->name('clinic.getClinic');
Route::delete('/clinic/get/{cipherid}', [ClinicController::class, 'delete'])->name('clinic.deleteClinic');


//google

Route::get('login-google', [AuthController::class, 'redirectToGoogle']);
Route::get('google-callback', [AuthController::class, 'callbackGoogle']);


//change language
Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');


//user
Route::get('/user/profile', [UserController::class,"showProfile"])->name('user.showProfile')->middleware("auth");

Route::get('user/settings', [UserController::class,"showSettings"])->name('user.showSetting')->middleware("auth");
