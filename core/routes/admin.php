<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PartnerController;

Route::prefix('admin')->middleware('admin')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    // Contact messages
    Route::get('/contact', [DashboardController::class, 'contact'])->name('admin.contact');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.status');

    // Partnership applications
    Route::get('/partners', [PartnerController::class, 'index'])->name('admin.partners.index');
    Route::post('/partners/{id}/status', [PartnerController::class, 'updateStatus'])->name('admin.partners.status');
    Route::delete('/partners/{id}', [PartnerController::class, 'destroy'])->name('admin.partners.destroy');
});
