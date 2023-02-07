<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\AuthController::class, 'authForm'])->name('login');
Route::get('auth', [\App\Http\Controllers\AuthController::class, 'auth'])->name('auth');
Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
