<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.beranda')->name('beranda');
Route::view('/barang', 'pages.barang')->name('barang');
Route::view('/layanan', 'pages.layanan')->name('layanan');
Route::view('/testimoni', 'pages.testimoni')->name('testimoni');
