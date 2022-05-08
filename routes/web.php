<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
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
    Route::get('/', fn () => view('login'))->name('login');
    Route::post('/', [AuthController::class, 'login']);
});

Route::prefix('register')->group(function () {
    Route::get('/', fn () => view('register'))->name('register');
    Route::post('/', [AuthController::class, 'register']);
});

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

Route::middleware(['auth', 'client.access'])->group(function () {
    Route::prefix('purchase')->group(function () {
        Route::get('/', [TransactionController::class, 'purchase'])->name('purchase.create');
        Route::post('/', [TransactionController::class, 'storePurchase'])->name('purchase.store');
    });

    Route::get('balance', [BalanceController::class, 'index']);

    Route::get('expenses', [TransactionController::class, 'expenses'])->name('expenses.index');

    Route::get('incomes', [TransactionController::class, 'incomes'])->name('incomes.index');

    Route::get('transactions/search', [TransactionController::class, 'search']);

    Route::prefix('checks')->group(function () {
        Route::get('/', [CheckController::class, 'index'])->name('checks.index');
        Route::get('/search', [CheckController::class, 'search'])->name('checks.search');
        Route::get('/create', [CheckController::class, 'create'])->name('checks.create');
        Route::post('/', [CheckController::class, 'store'])->name('checks.store');
    });
});
