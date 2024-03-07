<?php

use App\Http\Controllers\BuyArubaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FundsController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\WithdrawalController;
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

Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::group(['auth' => 'web'], function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/convert', [FundsController::class, 'index'])->name('transaction.convert');

    Route::get('/buy-aruba', [BuyArubaController::class, 'index'])->name('transaction.buy-awg');

    Route::get('/buy-aruba/{order:reference}', [BuyArubaController::class, 'show'])->name('transaction.buy-awg.show');

    Route::get('/withdraw', [WithdrawalController::class, 'index'])->name('transaction.withdraw');

    Route::get('/transfer', [TransferController::class, 'index'])->name('transaction.transfer');

});
