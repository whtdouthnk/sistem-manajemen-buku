<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\FBukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\AuthManualController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\DashboardController;

Route::get('/', [FBukuController::class, 'index'])->name('homepage');
Route::get('/katalog/{slug}', [FBukuController::class, 'show'])->name('detail-buku');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/buku/laporan', [BukuController::class, 'laporan'])->name('buku.laporan');
    Route::resource('kategori', KategoriController::class);
    Route::resource('penerbit', PenerbitController::class);
    Route::resource('buku', BukuController::class);
    
    Route::resource('anggota', AnggotaController::class)->parameters(['anggota'=>'anggota']);
    Route::resource('peminjaman', PeminjamanController::class)->parameters(['anggota'=>'anggota']);
});

Route::post('/upload-image', [BukuController::class, 'uploadImage'])->name('upload.image');
Route::get('/login', [AuthManualController::class, 'index'])->name('login');
Route::post('/login', [AuthManualController::class, 'loginProses'])->name('loginProses');
Route::post('/logout', [AuthManualController::class, 'logout'])->name('logout');
Route::get('/test', function(){
return view('test');
});