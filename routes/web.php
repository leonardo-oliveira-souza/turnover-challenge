<?php

use App\Http\Controllers\AuthController;
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

Route::prefix('login')->group(function () {
    Route::get('/', fn() => view('login'))->name('login');
    Route::post('/', [AuthController::class, 'login']);
});

Route::prefix('register')->group(function () {
    Route::get('/', fn() => view('register'))->name('register');
    Route::post('/', [AuthController::class, 'register']);
});

Route::get('logout', [AuthController::class, 'logout']);

Route::permanentRedirect('/', 'login');
