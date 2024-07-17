<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\JadwalJagaController;
use App\Http\Controllers\PengajuanController;
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



    /*---------------------------------BARANG-----------------------------------*/
    Route::resource('barang', BarangController::class);



    /*---------------------------------JADWAL JAGA-----------------------------------*/
    Route::resource('jadwal', JadwalJagaController::class);



    /*---------------------------------PENGAJUAN-----------------------------------*/
    Route::resource('pengajuan', PengajuanController::class);
    Route::get('/riwayat-pengajuan', [PengajuanController::class, 'riwayat'])->name('pengajuan.riwayat');
    Route::post('/pengajuan-perbaikan', [BarangController::class, 'pengajuan'])->name('pengajuan.perbaikan');
    Route::get('/pengajuan/terima/{pengajuan}', [PengajuanController::class, 'terimaPengajuan'])->name('pengajuan.terima');
    Route::get('/pengajuan/tolak/{pengajuan}', [PengajuanController::class, 'tolakPengajuan'])->name('pengajuan.tolak');


});
