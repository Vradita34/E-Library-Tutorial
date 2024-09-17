<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

// disnini middleware nya ssaya beri array sehingga bisa mengguankan dua middleware
Route::middleware(['auth','role:admin,librarian'])->group(function(){
    Route::resource('/user', UserController::class);

    Route::controller(AdminController::class)->group(function(){
        Route::get('/dashboard','dashboard')->name('dashboard');
    });
    Route::resource('/books',BooksController::class);
    Route::resource('/categories',CategoryController::class);
});


Route::controller(AuthController::class)->group(function(){
    Route::get('/register','register')->name('register')->middleware('guest');
    Route::post('/register_action','register_action')->name('register_action')->middleware('guest');
    Route::get('/login','login')->name('login')->middleware('guest');
    Route::post('/login_action','login_action')->name('login_action')->middleware('guest');
    Route::post('/logout','logout')->name('logout')->middleware('auth');
});


