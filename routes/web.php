<?php

use App\Domains\Payments\Controllers\PaymentRequestsController as FrontPaymentRequestsController;
use App\Domains\Sales\Http\Controllers\Front\SalesController;
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

Route::get('/p/{paymentRequest:slug}', [FrontPaymentRequestsController::class, 'show'])
    ->name('pay');

Route::get('/s/{sale:hash}', [SalesController::class, 'show'])->name('sales.show');
