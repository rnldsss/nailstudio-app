<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\FaqMessageController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StockManagementController;


Route::get('/', function () {
    return view('home');
});
// Rute Halaman Utama: Mengarahkan '/' ke NavbarController@index
Route::get('/', [NavbarController::class, 'index']);

// Rute-rute lainnya yang dibutuhkan oleh Navbar View Anda:
Route::get('/products/{category}', function ($category) {
    return view('pages.category', ['category' => $category]); 
});
Route::get('/login', function () { return view('auth.login'); });
Route::get('/register', function () { return view('auth.register'); });
Route::get('/favorite', function () { return view('pages.favorite'); });
Route::get('/checkout', function () { return view('pages.checkout'); });
Route::get('/cart-page', function () { return view('pages.cart_page'); });
Route::get('/profile', function () { return view('pages.profile'); });
Route::get('/search', function () { return view('pages.search'); });

// Rute untuk AJAX (Asumsi ini adalah file PHP murni yang akan Anda buat di public/cart/)
Route::any('/cart/cart_api.php', function () { return response()->json(['message' => 'Cart API placeholder']); });
Route::any('/cart/get_cart.php', function () { return 'Cart HTML placeholder'; });

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

// Route untuk Transaction History
Route::get('/transaction-history', [TransactionController::class, 'index'])->name('transaction.history');

// Halaman utama Management Stock & Harga
Route::get('/stock-management', [StockManagementController::class, 'index'])->name('stock.index');

// AJAX Endpoint untuk Tambah Stock
Route::post('/stock/add', [StockManagementController::class, 'updateStock'])->name('stock.updateStock');

// AJAX Endpoint untuk Ubah Harga/Diskon
Route::post('/stock/price', [StockManagementController::class, 'updatePrice'])->name('stock.updatePrice');
