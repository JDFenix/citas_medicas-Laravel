<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');


//appointments
Route::get("/appointment/register", [AppointmentController::class, 'create'])->name("appointment.formRegister")->middleware("auth");

