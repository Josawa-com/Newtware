<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.beranda')->name('beranda');
Route::view('/barang', 'pages.barang')->name('barang');
Route::view('/layanan', 'pages.layanan')->name('layanan');
Route::view('/testimoni', 'pages.testimoni')->name('testimoni');

Route::post('/bahasa', function (Request $request) {
    $locale = $request->validate([
        'locale' => ['required', 'in:id,en'],
    ])['locale'];

    $request->session()->put('locale', $locale);

    return back();
})->name('locale.switch');
