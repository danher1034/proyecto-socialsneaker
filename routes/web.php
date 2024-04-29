<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// Ruta para el index
Route::get('/', function () {return view('index');})->name('index');
// Rutas para el login y el singup
Route::get('signupForm', [LoginController::class, 'signupForm'])->name('signupForm');
Route::post('signup', [LoginController::class, 'signup'])->name('signup');
Route::get('loginForm', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
// Ruta para la cuenta del usuario y solo podrán entrar si estan logueados
Route::get('account', function() { return view('users.account'); })->name('account')->middleware('auth');
// Rutas para el apartado de usuario
Route::get('users/edit/{user}', [LoginController::class, 'edit'])->name('users/edit');
Route::put('users/update/{user}', [LoginController::class, 'update'])->name('users/update');
