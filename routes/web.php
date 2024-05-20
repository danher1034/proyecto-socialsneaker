<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ChatController;

// Ruta para el index
Route::get('/', function () {return view('index');})->name('index');
// Rutas para el login y el singup
Route::get('signupForm', [LoginController::class, 'signupForm'])->name('signupForm');
Route::post('signup', [LoginController::class, 'signup'])->name('signup');
Route::get('loginForm', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
// Ruta para la cuenta del usuario y solo podrán entrar si estan logueados
Route::get('account', [CollectionController::class, 'account'])->name('account')->middleware('auth');
// Rutas para el apartado de usuario
Route::get('users/edit/{user}', [LoginController::class, 'edit'])->name('users/edit');
Route::put('users/update/{user}', [LoginController::class, 'update'])->name('users/update');

Route::get('collections', [CollectionController::class, 'index'])->name('collections');
Route::get('collections/show/{collection}', [CollectionController::class, 'show'])->name('collections/show');

Route::post('collections/like/{collection}', [CollectionController::class, 'like'])->name('collections.like');
Route::get('collections/create', [CollectionController::class, 'create'])->name('collections/create');
Route::post('collections/store', [CollectionController::class, 'store'])->name('collections/store');
Route::get('collections/edit/{collection}', [CollectionController::class, 'edit'])->name('collections/edit');
Route::put('collections/update/{collection}', [CollectionController::class, 'update'])->name('collections/update');
Route::get('collections/destroy/{collection}', [CollectionController::class, 'destroy'])->name('collections/destroy');
Route::post('/collections/comment', [CollectionController::class, 'comment'])->name('collections.comment');

Route::middleware('auth')->group(function () {
    Route::get('chat', [ChatController::class, 'index'])->name('chat');
    Route::get('chat/show/{id}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('chat/store/{id}', [ChatController::class, 'store'])->name('chat.store');
    Route::get('chat/search', [ChatController::class, 'search'])->name('chat.search');
});


