<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\SubCriteriaController;

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('criteria', CriteriaController::class);

Route::resource('subcriteria', SubCriteriaController::class);