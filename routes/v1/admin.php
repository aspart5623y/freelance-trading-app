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




Route::middleware(['auth', 'admin_middleware', 'verified', 'blocked_user'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/home', [App\Http\Controllers\V1\Admin\HomeController::class, 'index'])->name('home');
    
    Route::get('/contact', [App\Http\Controllers\V1\Admin\ContactController::class, 'index'])->name('contact');

    Route::get('/send-mail', [App\Http\Controllers\V1\Admin\SendMailController::class, 'index'])->name('sendmail');
    Route::post('/send-mail', [App\Http\Controllers\V1\Admin\SendMailController::class, 'store'])->name('postmail');


    Route::get('/tranfer', [App\Http\Controllers\V1\Admin\AccountController::class, 'transfer'])->name('transfer');
    Route::post('/tranfer/fund', [App\Http\Controllers\V1\Admin\AccountController::class, 'transferFund'])->name('fund');


    Route::get('/deposit', [App\Http\Controllers\V1\Admin\DepositController::class, 'index'])->name('deposit');
    Route::post('/deposit/approve', [App\Http\Controllers\V1\Admin\DepositController::class, 'approve'])->name('deposit.approve');
    Route::post('/deposit/reject', [App\Http\Controllers\V1\Admin\DepositController::class, 'reject'])->name('deposit.reject');


    Route::get('/investments', [App\Http\Controllers\V1\Admin\InvestmentController::class, 'index'])->name('investment.index');

    
    Route::get('/profile', [App\Http\Controllers\V1\Admin\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [App\Http\Controllers\V1\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/disable', [App\Http\Controllers\V1\Admin\ProfileController::class, 'disable'])->name('profile.disable');


    Route::prefix('chat')->as('chat.')->group(function () {
        Route::get('/', [App\Http\Controllers\V1\Admin\ChatController::class, 'index'])->name('index');
        Route::get('/{conversation}', [App\Http\Controllers\V1\Admin\ChatController::class, 'conversation'])->name('conversation');
    });


    Route::get('/investors', [App\Http\Controllers\V1\Admin\UserController::class, 'investors'])->name('investors');
    Route::get('/traders', [App\Http\Controllers\V1\Admin\UserController::class, 'traders'])->name('traders');
    Route::get('/admins', [App\Http\Controllers\V1\Admin\UserController::class, 'admins'])->name('admins');

    Route::get('/user/{profile}', [App\Http\Controllers\V1\Admin\UserController::class, 'show'])->name('user.show');

    Route::get('/user/packages/{profile}', [App\Http\Controllers\V1\Admin\UserController::class, 'packages'])->name('user.packages');


    Route::post('/trader/verify', [App\Http\Controllers\V1\Admin\UserController::class, 'verifyTrader'])->name('trader.verify');
    Route::post('/user/ban', [App\Http\Controllers\V1\Admin\UserController::class, 'disable'])->name('user.disable');
    Route::post('/user/create/admin', [App\Http\Controllers\V1\Admin\UserController::class, 'createAdmin'])->name('user.createAdmin');
    Route::post('/user/update/admin/{profile}', [App\Http\Controllers\V1\Admin\UserController::class, 'updateAdmin'])->name('user.updateAdmin');
    Route::post('/user/update/investor/{profile}', [App\Http\Controllers\V1\Admin\UserController::class, 'updateInvestor'])->name('user.updateInvestor');
    Route::post('/user/update/trader/{profile}', [App\Http\Controllers\V1\Admin\UserController::class, 'updateTrader'])->name('user.updateTrader');
    Route::post('/user/delete', [App\Http\Controllers\V1\Admin\UserController::class, 'deleteAccount'])->name('user.delete');
    

    Route::post('/user/approve/kyc/{profile}', [App\Http\Controllers\V1\Admin\UserController::class, 'approveKYC'])->name('user.approveKYC');
    Route::post('/user/reject/kyc/{profile}', [App\Http\Controllers\V1\Admin\UserController::class, 'rejectKYC'])->name('user.rejectKYC');


    Route::post('/user/meeting/schedule/{trader}', [App\Http\Controllers\V1\Admin\UserController::class, 'sendMeetingLink'])->name('user.scheduleMeeting');
    Route::post('/user/meeting/done/{trader}/{meeting}', [App\Http\Controllers\V1\Admin\UserController::class, 'doneMeeting'])->name('user.doneMeeting');
    Route::post('/user/meeting/cancel/{trader}/{meeting}', [App\Http\Controllers\V1\Admin\UserController::class, 'cancelMeeting'])->name('user.cancelMeeting');


    Route::get('/settings', [App\Http\Controllers\V1\Admin\SettingsController::class, 'index'])->name('settings');
    Route::post('/profile/delete', [App\Http\Controllers\V1\Admin\SettingsController::class, 'destroy'])->name('delete.profile');
    Route::get('/settings/password', [App\Http\Controllers\V1\Admin\SettingsController::class, 'password'])->name('password');
    Route::post('/settings/password/update', [App\Http\Controllers\V1\Admin\SettingsController::class, 'update'])->name('update.password');
    
    Route::get('/settings/service', [App\Http\Controllers\V1\Admin\SettingsController::class, 'service'])->name('service');
    Route::post('/settings/service/store', [App\Http\Controllers\V1\Admin\SettingsController::class, 'storeService'])->name('service.store');
    Route::get('/settings/service/edit/{service}', [App\Http\Controllers\V1\Admin\SettingsController::class, 'editService'])->name('service.edit');
    Route::post('/settings/service/update/{service}', [App\Http\Controllers\V1\Admin\SettingsController::class, 'updateService'])->name('service.update');
    Route::post('/settings/service/delete', [App\Http\Controllers\V1\Admin\SettingsController::class, 'deleteService'])->name('service.delete');

    Route::get('/profile/settings/check', [App\Http\Controllers\V1\Admin\SettingsController::class, 'checkPassword'])->name('check');
    Route::post('/settings/confirm/password', [App\Http\Controllers\V1\Admin\SettingsController::class, 'confirmPassword'])->name('confirm.password');
    Route::get('/settings/pin', [App\Http\Controllers\V1\Admin\SettingsController::class, 'pin'])->name('pin');
    Route::post('/settings/pin/update', [App\Http\Controllers\V1\Admin\SettingsController::class, 'updatePin'])->name('update.pin');


    Route::get('/settings/company-info', [App\Http\Controllers\V1\Admin\AccountController::class, 'companyInfo'])->name('company');
    Route::post('/settings/company-info/update', [App\Http\Controllers\V1\Admin\AccountController::class, 'updateCompanyInfo'])->name('update.company');

    Route::get('/settings/account-info', [App\Http\Controllers\V1\Admin\AccountController::class, 'accountInfo'])->name('accounts');
    Route::post('/settings/account-info/store', [App\Http\Controllers\V1\Admin\AccountController::class, 'updateAccountInfo'])->name('store.account');
    Route::post('/settings/account-info/delete', [App\Http\Controllers\V1\Admin\AccountController::class, 'destroy'])->name('delete.account');



    Route::get('/withdrawal', [App\Http\Controllers\V1\Admin\WithdrawalController::class, 'index'])->name('withdrawal');
    Route::post('/withdrawal/approve', [App\Http\Controllers\V1\Admin\WithdrawalController::class, 'approve'])->name('withdrawal.approve');
    Route::post('/withdrawal/reject', [App\Http\Controllers\V1\Admin\WithdrawalController::class, 'reject'])->name('withdrawal.reject');

});
