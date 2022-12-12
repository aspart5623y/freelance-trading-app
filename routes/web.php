<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


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


Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])
        ->name('index')->middleware('guest');

Route::get('/trader', function () {
    return view('welcome-trader'); 
})->name('welcome.trader')->middleware('guest');


Route::get('/contact/support', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact/support', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::get('/register/info', [App\Http\Controllers\Auth\RegisterController::class, 'submitType'])->name('createAccount');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::get('password/new/{email}', [App\Http\Controllers\Auth\LoginController::class, 'setPassword'])->name('password.new');
Route::post('password/set', [App\Http\Controllers\Auth\LoginController::class, 'savePassword'])->name('password.save');








Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/login')
            ->with('success','Your account has been successfully created and verified. You are now logged into your dashboard.');

})->middleware(['auth', 'signed'])->name('verification.verify');


 
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Auth::routes();






Route::get('/profile/api/{profile}', [App\Http\Controllers\TransferApiController::class, 'apiGetName']);
Route::post('/tranfer/pin', [App\Http\Controllers\TransferApiController::class, 'checkPin'])->name('validate');
Route::get('/investment/details/{investment}', [App\Http\Controllers\TransferApiController::class, 'showInvestment']);
