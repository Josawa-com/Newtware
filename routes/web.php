<?php

use App\Http\Controllers\RatingController;
use App\Http\Controllers\ServiceDetailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.beranda')->name('beranda');
Route::view('/barang', 'pages.barang')->name('barang');
Route::view('/layanan', 'pages.layanan')->name('layanan');
Route::get('/testimoni', [RatingController::class, 'index'])->name('testimoni');
Route::post('/testimoni', [RatingController::class, 'store'])->name('testimoni.store');

$serviceSlugs = implode('|', array_map(
    fn (string $slug): string => preg_quote($slug, '/'),
    ServiceDetailController::slugs(),
));

Route::get('/layanan/{slug}', [ServiceDetailController::class, 'show'])
    ->where(['slug' => $serviceSlugs])
    ->name('layanan.detail');

Route::post('/bahasa', function (Request $request) {
    $locale = $request->validate([
        'locale' => ['required', 'in:id,en'],
    ])['locale'];

    $request->session()->put('locale', $locale);

    if ($request->expectsJson()) {
        return response()->json(['locale' => $locale]);
    }

    return back();
})->name('locale.switch');
