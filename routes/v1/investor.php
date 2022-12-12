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






Route::middleware(['auth', 'investor_middleware', 'verified', 'blocked_user'])->prefix('investor')->name('investor.')->group(function () {
    Route::get('/home', [App\Http\Controllers\V1\Investor\HomeController::class, 'index'])->name('home');
    
    Route::get('/fund-wallet', [App\Http\Controllers\V1\Investor\AccountController::class, 'fund'])->name('fund.wallet');
    Route::post('/wallet-transfer', [App\Http\Controllers\V1\Investor\AccountController::class, 'walletTransfer'])->name('wallet.transfer');
    Route::get('/wallet-address/{amount}/{account}', [App\Http\Controllers\V1\Investor\AccountController::class, 'walletAddress'])->name('wallet.address');
    Route::post('/fund/proof', [App\Http\Controllers\V1\Investor\AccountController::class, 'fundWallet'])->name('fund.proof');
    
    
    Route::prefix('profile')->group(function () {
        Route::get('', [App\Http\Controllers\V1\Investor\ProfileController::class, 'index'])->name('profile');
        Route::post('/update', [App\Http\Controllers\V1\Investor\ProfileController::class, 'update'])->name('update.profile');
        Route::post('/kyc', [App\Http\Controllers\V1\Investor\ProfileController::class, 'kycVerification'])->name('update.kyc');
        Route::post('/delete', [App\Http\Controllers\V1\Investor\ProfileController::class, 'destroy'])->name('delete.profile');
        

        Route::get('/tranfer', [App\Http\Controllers\V1\Investor\AccountController::class, 'transfer'])->name('transfer');
        Route::post('/tranfer/fund', [App\Http\Controllers\V1\Investor\AccountController::class, 'transferFund'])->name('fund');



        Route::get('/accounts/bank', [App\Http\Controllers\V1\Investor\AccountController::class, 'bank'])->name('bank');
        Route::post('/accounts/bank', [App\Http\Controllers\V1\Investor\AccountController::class, 'addBank'])->name('bank.add');
    
        Route::get('/accounts/crypto', [App\Http\Controllers\V1\Investor\AccountController::class, 'crypto'])->name('crypto');
        Route::post('/accounts/crypto', [App\Http\Controllers\V1\Investor\AccountController::class, 'addCrypto'])->name('crypto.add');

    
        Route::get('/accounts/paypal', [App\Http\Controllers\V1\Investor\AccountController::class, 'paypal'])->name('paypal');
        Route::post('/accounts/paypal', [App\Http\Controllers\V1\Investor\AccountController::class, 'addPaypal'])->name('paypal.add');

        Route::post('/accounts/delete', [App\Http\Controllers\V1\Investor\AccountController::class, 'destroy'])->name('account.delete');
    
    
        Route::get('/picture/change', [App\Http\Controllers\V1\Investor\ProfileController::class, 'image'])->name('change.image');
        Route::post('/picture/update', [App\Http\Controllers\V1\Investor\ProfileController::class, 'updateImage'])->name('update.image');
    
        Route::get('/settings', [App\Http\Controllers\V1\Investor\SettingsController::class, 'index'])->name('settings');
        Route::post('/delete', [App\Http\Controllers\V1\Investor\SettingsController::class, 'destroy'])->name('delete.profile');
        Route::get('/settings/password', [App\Http\Controllers\V1\Investor\SettingsController::class, 'password'])->name('password');
        Route::post('/settings/password/update', [App\Http\Controllers\V1\Investor\SettingsController::class, 'update'])->name('update.password');
        Route::get('/settings/check', [App\Http\Controllers\V1\Investor\SettingsController::class, 'checkPassword'])->name('check');
        Route::post('/settings/confirm/password', [App\Http\Controllers\V1\Investor\SettingsController::class, 'confirmPassword'])->name('confirm.password');
        Route::get('/settings/pin', [App\Http\Controllers\V1\Investor\SettingsController::class, 'pin'])->name('pin');
        Route::post('/settings/pin/update', [App\Http\Controllers\V1\Investor\SettingsController::class, 'updatePin'])->name('update.pin');
    });


    Route::get('/packages', [App\Http\Controllers\V1\Investor\PackageController::class, 'index'])->name('package.index');
    Route::get('packages/services', [App\Http\Controllers\V1\Investor\PackageController::class, 'services'])->name('package.services');
    Route::get('packages/service/{service}', [App\Http\Controllers\V1\Investor\PackageController::class, 'service'])->name('package.service');
    Route::get('/package/view/{package}', [App\Http\Controllers\V1\Investor\PackageController::class, 'show'])->name('package.show');
    Route::get('/package/search', [App\Http\Controllers\V1\Investor\PackageController::class, 'search'])->name('package.search');



    Route::get('/investments', [App\Http\Controllers\V1\Investor\InvestmentController::class, 'index'])->name('investment.index');
    Route::post('/investments/store', [App\Http\Controllers\V1\Investor\InvestmentController::class, 'store'])->name('investment.store');
    Route::post('/investments/cancel', [App\Http\Controllers\V1\Investor\InvestmentController::class, 'cancel'])->name('investment.cancel');


    
    Route::prefix('chat')->as('chat.')->group(function () {
        Route::get('/', [App\Http\Controllers\V1\Investor\ChatController::class, 'index'])->name('index');
        Route::get('/{conversation}', [App\Http\Controllers\V1\Investor\ChatController::class, 'conversation'])->name('conversation');
        Route::post('/store', [App\Http\Controllers\V1\Investor\ChatController::class, 'store'])->name('store');
    });
    
    Route::get('/traders', [App\Http\Controllers\V1\Investor\TraderController::class, 'index'])->name('trader.index');
    Route::get('/trader/show/{profile}', [App\Http\Controllers\V1\Investor\TraderController::class, 'show'])->name('trader.show');
    Route::get('/trader/packages/{profile}', [App\Http\Controllers\V1\Investor\TraderController::class, 'packages'])->name('trader.packages');
    Route::get('/trader/chat/{profile}', [App\Http\Controllers\V1\Investor\TraderController::class, 'chat'])->name('trader.chat');
    Route::get('/trader/search', [App\Http\Controllers\V1\Investor\TraderController::class, 'search'])->name('trader.search');
    Route::post('/trader/rate', [App\Http\Controllers\V1\Investor\TraderController::class, 'rate'])->name('trader.rate');

    

    Route::get('/withdrawal', [App\Http\Controllers\V1\Investor\WithdrawalController::class, 'index'])->name('withdrawal');
    Route::get('/withdrawal/request', [App\Http\Controllers\V1\Investor\WithdrawalController::class, 'create'])->name('withdrawal.create');
    Route::post('/withdrawal/request', [App\Http\Controllers\V1\Investor\WithdrawalController::class, 'store'])->name('withdrawal.store');

});