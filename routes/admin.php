<?php

use App\Domains\Invoices\Controllers\Admin\InvoicesController;
use App\Domains\Payments\Controllers\Admin\OrdersController;
use App\Domains\Sales\Http\Controllers\Admin\SaleActionsController;
use App\Domains\Sales\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\LoginAsUserController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login/{data}', [LoginAsUserController::class, 'login'])->name('admin.login');

Route::middleware(['auth:sanctum', 'verified'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

        Route::prefix('sales')
            ->as('sales.')
            ->group(function () {
                Route::get('/', [SalesController::class, 'index'])->name('index');
                Route::post('/', [SalesController::class, 'store'])->name('store');
                Route::get('create', [SalesController::class, 'create'])->name('create');
                Route::get('/{sale}', [SalesController::class, 'edit'])->name('edit');
                Route::post('/{sale}', [SalesController::class, 'update'])->name('update');
                Route::delete('/{sale}', [SalesController::class, 'delete'])->name('delete');
                Route::get('/{sale}/addaction/{action}', [SaleActionsController::class, 'create'])
                    ->name('add_action');
                Route::post('/{sale}/toggle', [SalesController::class, 'toggle'])->name('toggle');
            });

        Route::prefix('actions')
            ->as('actions.')
            ->group(function () {
                Route::delete('/{action}', [SaleActionsController::class, 'destroy'])->name('destroy');
                Route::get('/retry/{order}', [SaleActionsController::class, 'retry'])->name('retry');
                Route::get('/{order}/manual_invoice', [InvoicesController::class, 'manual'])
                    ->name('manual_invoice');
            });

        Route::prefix('orders')
            ->as('orders.')
            ->group(function () {
                Route::get('/', [OrdersController::class, 'index'])->name('index');
                Route::get('/pending', [OrdersController::class, 'pending'])->name('pending');
                Route::get('/{order}/resend', [OrdersController::class, 'resend'])->name('resend');
                Route::delete('/{order}', [OrdersController::class, 'destroy'])->name('delete');
            });

        Route::prefix('invoices')
            ->as('invoices.')
            ->group(function () {
                Route::get('/', [InvoicesController::class, 'index'])->name('index');
                Route::get('/{invoice}', [InvoicesController::class, 'show'])->name('show');
                Route::delete('/{invoice}', [InvoicesController::class, 'destroy'])->name('delete');
                Route::get('/{invoice}/accept', [InvoicesController::class, 'accept'])->name('accept');
            });
    });
