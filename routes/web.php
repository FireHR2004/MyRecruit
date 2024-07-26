<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\ScoringController;
use App\Http\Controllers\PerhitunganController;

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile', function () {
    return view('profile');
});
Route::resource('kriteria', KriteriaController::class);
Route::resource('subkriteria', SubKriteriaController::class);
Route::resource('alternatif', AlternatifController::class);
Route::resource('penilaian', PenilaianController::class);
Route::resource('scoring', ScoringController::class);
Route::put('/scoring/{id}', [ScoringController::class, 'update'])->name('scoring.update');
Route::get('/perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan');
Route::get('/result', [PerhitunganController::class, 'ranking'])->name('result');
