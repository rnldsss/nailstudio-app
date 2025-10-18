<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NavbarController;

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