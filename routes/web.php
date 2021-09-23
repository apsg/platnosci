<?php

use App\Domains\Payments\Controllers\Admin\PaymentRequestsController;
use App\Domains\Payments\Controllers\PaymentRequestsController as FrontPaymentRequestsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->prefix('admin')
    ->group(function () {

        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

        Route::view('/payments', 'admin.payments.index')->name('payments.index');
        Route::view('/payments/create', 'admin.payments.create')->name('payments.create');
        Route::post('/payments', [PaymentRequestsController::class, 'store'])
            ->name('payments.store');
        Route::get('/payments/{paymentRequest}', [PaymentRequestsController::class, 'show'])
            ->name('payments.show');
    });

Route::get('/p/{paymentRequest:slug}', [FrontPaymentRequestsController::class, 'show'])
    ->name('pay');
