<?php

use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('auth.login');
});


/*---------------------------------ROUTE TERAUTENTIKASI-----------------------------------*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('home', function () {
        return view('admin.home');
    })->name('home');

    Route::get('profile', function () {
        return view('auth.profile');
    })->name('profile');


    /*---------------------------------PENGGUNA-----------------------------------*/
    Route::resource('pengguna', PenggunaController::class);

});
