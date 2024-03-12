<?php

use App\Http\Controllers\BuyArubaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FundsController;
use App\Http\Controllers\MerchantController;
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

    Route::put('/profile/banking-details', [DashboardController::class, 'updateBankDetails'])->name('dashboard.banking-details.update');

    Route::get('/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');


    Route::get('/merchant/profile', [MerchantController::class, 'edit'])->name('dashboard.merchant');

    Route::put('/merchant/profile', [MerchantController::class, 'update'])->name('dashboard.merchant.update');

    Route::get('/merchant/orders', [MerchantController::class, 'index'])->name('dashboard.merchant.orders');

    Route::get('/merchant/orders/{order:reference}', [MerchantController::class, 'view'])->name('dashboard.merchant.orders.view');



    Route::get('/convert-funds', [FundsController::class, 'create'])->name('transaction.convert');

    Route::get('/convert-funds/list', [FundsController::class, 'index'])->name('transaction.convert.index');



    Route::get('/buy-aruba', [BuyArubaController::class, 'create'])->name('transaction.buy-awg.create');

    Route::get('/buy-aruba/orders', [BuyArubaController::class, 'index'])->name('transaction.buy-awg.index');

    Route::get('/buy-aruba/{order:reference}', [BuyArubaController::class, 'show'])->name('transaction.buy-awg.show');



    Route::get('/withdrawals', [WithdrawalController::class, 'index'])->name('transaction.withdrawal.index');

    Route::get('/withdraw-funds', [WithdrawalController::class, 'create'])->name('transaction.withdrawal.create');



    Route::get('/transfers', [TransferController::class, 'index'])->name('transaction.transfer.index');

    Route::get('/transfer-funds', [TransferController::class, 'index'])->name('transaction.transfer.create');

});

Route::view('privacy-policy', 'policy')->name('privacy-policy');

Route::view('terms-and-conditions', 'terms')->name('terms-and-conditions');

Route::view('become-a-merchant', 'become_a_merchant')->name('become-a-merchant');
