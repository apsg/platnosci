<?php

use App\Domains\Payments\Controllers\Admin\PaymentRequestsController;
use App\Domains\Sales\Http\Controllers\Admin\SalesController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
        Route::view('/payments', 'admin.payments.index')->name('payments.index');
        Route::view('/payments/create', 'admin.payments.create')->name('payments.create');
        Route::post('/payments', [PaymentRequestsController::class, 'store'])
            ->name('payments.store');
        Route::get('/payments/{paymentRequest}', [PaymentRequestsController::class, 'show'])
            ->name('payments.show');
        Route::patch('/payments/{paymentRequest}', [PaymentRequestsController::class, 'update'])
            ->name('payments.update');


        Route::prefix('sales')
            ->as('sales.')
            ->group(function () {
                Route::get('/', [SalesController::class, 'index'])->name('index');
                Route::post('/', [SalesController::class, 'store'])->name('store');
                Route::get('create', [SalesController::class, 'create'])->name('create');
                Route::get('/{sale}', [SalesController::class, 'edit'])->name('edit');
                Route::post('/{sale}', [SalesController::class, 'update'])->name('update');
            });
    });
