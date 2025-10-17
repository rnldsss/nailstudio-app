<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Route GET untuk menampilkan Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Route POST untuk simulasi update status
Route::post('/dashboard/update-status', [DashboardController::class, 'updateStatus'])->name('dashboard.updateStatus');