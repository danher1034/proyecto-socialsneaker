<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí se encuentran las rutas a las cuales se pueden acceder
|
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LocaleController;

Route::get('/', function () {
    return redirect('/account');
})->name('index');

Route::get('signupForm', [LoginController::class, 'signupForm'])->name('signupForm');
Route::get('loginForm', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('signup', [LoginController::class, 'signup'])->name('signup');
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::get('locale/{lang}', [LocaleController::class, 'setLocale'])->name('locale.switch');

Route::middleware('auth')->group(function () {
    Route::get('account', [CollectionController::class, 'account'])->name('account');
    Route::get('account/{userId}', [CollectionController::class, 'account'])->name('account.user');
    Route::post('/follow/{id}', [FollowController::class, 'follow'])->name('follow');

    Route::get('users/edit/{user}', [LoginController::class, 'edit'])->name('users/edit');
    Route::put('users/update/{user}', [LoginController::class, 'update'])->name('users/update');
    Route::delete('users/delete/{user}', [LoginController::class, 'delete'])->name('users/delete');

    Route::get('search', [SearchController::class, 'index'])->name('search');

    Route::get('collections', [CollectionController::class, 'index'])->name('collections');
    Route::get('collections/show/{collection}', [CollectionController::class, 'show'])->name('collections/show');
    Route::post('collections/like/{collection}', [CollectionController::class, 'like'])->name('collections/like');
    Route::get('collections/create', [CollectionController::class, 'create'])->name('collections/create');
    Route::post('collections/store', [CollectionController::class, 'store'])->name('collections/store');
    Route::get('collections/edit/{collection}', [CollectionController::class, 'edit'])->name('collections/edit');
    Route::put('collections/update/{collection}', [CollectionController::class, 'update'])->name('collections/update');
    Route::get('collections/destroy/{collection}', [CollectionController::class, 'destroy'])->name('collections/destroy');
    Route::post('collections/comment', [CollectionController::class, 'comment'])->name('collections/comment');

    Route::get('chat', [ChatController::class, 'index'])->name('chat');
    Route::get('chat/show/{id}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('chat/store/{id}', [ChatController::class, 'store'])->name('chat.store');
    Route::get('chat/search', [ChatController::class, 'search'])->name('chat.search');
    Route::get('chat/newMessages/{id}', [ChatController::class, 'newMessages'])->name('chat.newMessages');

    Route::get('news', [NewsController::class, 'index'])->name('news');
    Route::get('news/create', [NewsController::class, 'create'])->name('news/create');
    Route::post('news/store', [NewsController::class, 'store'])->name('news/store');
    Route::get('news/edit/{news}', [NewsController::class, 'edit'])->name('news/edit');
    Route::put('news/update/{news}', [NewsController::class, 'update'])->name('news/update');
    Route::get('news/destroy/{news}', [NewsController::class, 'destroy'])->name('news/destroy');

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});


