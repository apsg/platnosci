<?php

use App\Domains\Payments\Controllers\OrdersController;
use App\Domains\Payu\Controllers\PayuIpnController;
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

Route::get('/s/{sale:hash}', [SalesController::class, 'show'])->name('sales.show');
Route::get('/o/{order:hash}', [OrdersController::class, 'continue'])->name('orders.continue');
Route::get('/o/{order:hash}/invoice', [OrdersController::class, 'invoice'])->name('orders.invoice');

Route::any('/payu/ipn', PayuIpnController::class)->name('payu.ipn');
Route::any('/p24/ipn', PayuIpnController::class)->name('p24.ipn');
