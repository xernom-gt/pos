<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('order', [OrderController::class, 'index'])->name('order.index');
Route::post('order', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/{order}/print', [OrderController::class, 'print'])->name('order.print');