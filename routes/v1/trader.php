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




Route::middleware(['auth', 'trader_middleware', 'verified', 'blocked_user'])->prefix('trader')->name('trader.')->group(function () {
    Route::get('/home', [App\Http\Controllers\V1\Trader\HomeController::class, 'index'])->name('home');

    Route::get('/fund-wallet', [App\Http\Controllers\V1\Trader\AccountController::class, 'fund'])->name('fund.wallet');
    Route::post('/fund/proof', [App\Http\Controllers\V1\Trader\AccountController::class, 'fundWallet'])->name('fund.proof');
    Route::post('/wallet-transfer', [App\Http\Controllers\V1\Trader\AccountController::class, 'walletTransfer'])->name('wallet.transfer');
    Route::get('/wallet-address/{amount}/{account}', [App\Http\Controllers\V1\Trader\AccountController::class, 'walletAddress'])->name('wallet.address');

    Route::prefix('profile')->group(function () {

        Route::get('', [App\Http\Controllers\V1\Trader\ProfileController::class, 'index'])->name('profile');
        Route::post('/update', [App\Http\Controllers\V1\Trader\ProfileController::class, 'update'])->name('update.profile');
        Route::post('/kyc', [App\Http\Controllers\V1\Trader\ProfileController::class, 'kycVerification'])->name('update.kyc');

        

        Route::get('/tranfer', [App\Http\Controllers\V1\Trader\AccountController::class, 'transfer'])->name('transfer');
        Route::post('/tranfer/fund', [App\Http\Controllers\V1\Trader\AccountController::class, 'transferFund'])->name('fund');



        Route::get('/accounts/bank', [App\Http\Controllers\V1\Trader\AccountController::class, 'bank'])->name('bank');
        Route::post('/accounts/bank', [App\Http\Controllers\V1\Trader\AccountController::class, 'addBank'])->name('bank.add');

        Route::get('/accounts/crypto', [App\Http\Controllers\V1\Trader\AccountController::class, 'crypto'])->name('crypto');
        Route::post('/accounts/crypto', [App\Http\Controllers\V1\Trader\AccountController::class, 'addCrypto'])->name('crypto.add');
        
        Route::get('/accounts/paypal', [App\Http\Controllers\V1\Trader\AccountController::class, 'paypal'])->name('paypal');
        Route::post('/accounts/paypal', [App\Http\Controllers\V1\Trader\AccountController::class, 'addPaypal'])->name('paypal.add');

        Route::post('/accounts/delete', [App\Http\Controllers\V1\Trader\AccountController::class, 'destroy'])->name('account.delete');
        
        

        Route::get('/picture/change', [App\Http\Controllers\V1\Trader\ProfileController::class, 'image'])->name('change.image');
        Route::post('/picture/update', [App\Http\Controllers\V1\Trader\ProfileController::class, 'updateImage'])->name('update.image');
        


        Route::get('/settings', [App\Http\Controllers\V1\Trader\SettingsController::class, 'index'])->name('settings');
        Route::post('/delete', [App\Http\Controllers\V1\Trader\SettingsController::class, 'destroy'])->name('delete.profile');
        Route::get('/settings/password', [App\Http\Controllers\V1\Trader\SettingsController::class, 'password'])->name('password');
        Route::post('/settings/password/update', [App\Http\Controllers\V1\Trader\SettingsController::class, 'update'])->name('update.password');
        Route::get('/settings/check', [App\Http\Controllers\V1\Trader\SettingsController::class, 'checkPassword'])->name('check');
        Route::post('/settings/confirm/password', [App\Http\Controllers\V1\Trader\SettingsController::class, 'confirmPassword'])->name('confirm.password');
        Route::get('/settings/pin', [App\Http\Controllers\V1\Trader\SettingsController::class, 'pin'])->name('pin');
        Route::post('/settings/pin/update', [App\Http\Controllers\V1\Trader\SettingsController::class, 'updatePin'])->name('update.pin');
    });


    Route::get('/packages', [App\Http\Controllers\V1\Trader\PackagesController::class, 'index'])->name('packages');
    Route::get('/package/create', [App\Http\Controllers\V1\Trader\PackagesController::class, 'create'])->name('package.create');
    Route::post('/package/store', [App\Http\Controllers\V1\Trader\PackagesController::class, 'store'])->name('package.store');
    Route::get('/package/edit/{package}', [App\Http\Controllers\V1\Trader\PackagesController::class, 'edit'])->name('package.edit');
    Route::post('/package/update/{package}', [App\Http\Controllers\V1\Trader\PackagesController::class, 'update'])->name('package.update');
    Route::post('/package/delete', [App\Http\Controllers\V1\Trader\PackagesController::class, 'destroy'])->name('package.delete');



    Route::prefix('chat')->as('chat.')->group(function () {
        Route::get('/', [App\Http\Controllers\V1\Trader\ChatController::class, 'index'])->name('index');
        Route::get('/{conversation}', [App\Http\Controllers\V1\Trader\ChatController::class, 'conversation'])->name('conversation');
        Route::post('/store', [App\Http\Controllers\V1\Trader\ChatController::class, 'store'])->name('store');
    });
    



    Route::get('/investments', [App\Http\Controllers\V1\Trader\InvestmentController::class, 'index'])->name('investment.index');
    Route::post('/investments/update', [App\Http\Controllers\V1\Trader\InvestmentController::class, 'update'])->name('investment.update');

    

    Route::get('/withdrawal', [App\Http\Controllers\V1\Trader\WithdrawalController::class, 'index'])->name('withdrawal');
    Route::get('/withdrawal/request', [App\Http\Controllers\V1\Trader\WithdrawalController::class, 'create'])->name('withdrawal.create');
    Route::post('/withdrawal/request', [App\Http\Controllers\V1\Trader\WithdrawalController::class, 'store'])->name('withdrawal.store');

    
});