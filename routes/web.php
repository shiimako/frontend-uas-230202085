<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pasien', [\App\Http\Controllers\Pasien::class, 'getallpasien'])->name('pasien.index');
Route::get('/pasien/edit/{id}', [\App\Http\Controllers\Pasien::class, 'getpasienbyid'])->name('pasien.show');
Route::post('/pasien', [\App\Http\Controllers\Pasien::class, 'savepasien'])->name('pasien.store');
Route::get('/pasien/tambah', function () {return view('pasien.tambah');})->name('pasien.create');
Route::put('/pasien/{id}', [\App\Http\Controllers\Pasien::class, 'updatepasien'])->name('pasien.update');
Route::delete('/pasien/{id}', [\App\Http\Controllers\Pasien::class, 'deletepasien'])->name('pasien.destroy');

Route::get('/obat', [\App\Http\Controllers\Obat::class, 'getallobat'])->name('obat.index');
Route::get('/obat/edit/{id}', [\App\Http\Controllers\Obat::class, 'getobatbyid'])->name('obat.show');
Route::post('/obat', [\App\Http\Controllers\Obat::class, 'saveobat'])->name('obat.store');
Route::get('/obat/tambah', function () {return view('obat.tambah');})->name('obat.create');
Route::put('/obat/{id}', [\App\Http\Controllers\Obat::class, 'updateobat'])->name('obat.update');
Route::delete('/obat/delete/{id}', [\App\Http\Controllers\Obat::class, 'deleteobat'])->name('obat.destroy');
