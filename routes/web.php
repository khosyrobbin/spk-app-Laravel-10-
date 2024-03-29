<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BeasiswaController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SeleksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [KriteriaController::class, 'index']);

Auth::routes();


Route::get('/home', [App\Http\Controllers\KriteriaController::class, 'index'])->name('home');
Route::resource('kriteria', KriteriaController::class);
Route::resource('indikator', IndikatorController::class);
Route::resource('beasiswa', BeasiswaController::class);
Route::resource('seleksi', SeleksiController::class);
Route::resource('informasi', InfoController::class);

// route topsis
Route::get('/seleksi/topsis/{beasiswa_id}', [SeleksiController::class, 'topsis'])->name('topsis');
