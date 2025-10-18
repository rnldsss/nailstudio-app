<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\FaqMessageController;

// Route GET untuk menampilkan Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Route POST untuk simulasi update status
Route::post('/dashboard/update-status', [DashboardController::class, 'updateStatus'])->name('dashboard.updateStatus');

Route::get('/product', [ProductAdminController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductAdminController::class, 'create'])->name('product.create');
Route::post('/product/store', [ProductAdminController::class, 'store'])->name('product.store');
Route::get('/product/edit/{id}', [ProductAdminController::class, 'edit'])->name('product.edit');
Route::delete('/product/destroy/{id}', [ProductAdminController::class, 'destroy'])->name('product.destroy');

// Route untuk halaman Analytics
Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

// Route untuk halaman FAQ Message (GET)
Route::get('/faq', [FaqMessageController::class, 'index'])->name('faq.index');

// Route untuk submit jawaban (POST)
Route::post('/faq/submit', [FaqMessageController::class, 'submitAnswer'])->name('faq.submit');
