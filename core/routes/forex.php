<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForexController;
use App\Http\Controllers\OrderController;

Route::controller(ForexController::class)->group(function () {
    Route::get('/', 'home')->name('forex.home');
    Route::get('/dark-algo', 'product')->name('forex.product.dark-algo')->defaults('slug', 'dark-algo');
    Route::get('/dark-nova', 'product')->name('forex.product.dark-nova')->defaults('slug', 'dark-nova');
    Route::get('/dark-kronos', 'product')->name('forex.product.dark-kronos')->defaults('slug', 'dark-kronos');
    Route::get('/dark-titan', 'product')->name('forex.product.dark-titan')->defaults('slug', 'dark-titan');
    Route::get('/dark-gold', 'product')->name('forex.product.dark-gold')->defaults('slug', 'dark-gold');
    Route::get('/source-codes', 'sourceCodes')->name('forex.source-codes');
    Route::get('/partnership', 'partnership')->name('forex.partnership');
    Route::post('/partnership', 'partnerSubmit')->name('forex.partner-submit');
    Route::get('/free-eas', 'freeEas')->name('forex.free-eas');
    Route::get('/contact-us', 'contactUs')->name('forex.contact-us');
    Route::post('/contact-us', 'contactSubmit')->name('forex.contact-submit');
    Route::get('/cart', 'cart')->name('forex.cart');
    Route::get('/knowledgebase', 'knowledgebase')->name('forex.knowledgebase');
    Route::get('/terms-of-services', 'terms')->name('forex.terms');
    Route::get('/privacy-policy', 'privacy')->name('forex.privacy');
    Route::get('/cookie-policy', 'cookies')->name('forex.cookies');
});

// Login redirect (uses frontend auth system)
Route::get('/forex-login', function () {
    return redirect()->route('login');
})->name('forex.login');

// Order routes
Route::post('/order', [OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');
Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('forex.my-orders')->middleware('auth');
Route::get('/my-partnership', [ForexController::class, 'myPartnership'])->name('forex.my-partnership')->middleware('auth');

