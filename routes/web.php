<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\FaqMessageController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StockManagementController;
use App\Http\Controllers\BestSellerController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AboutUsController;




Route::get('/', function () {
    return view('home');
});
// Rute Halaman Utama: Mengarahkan  ke NavbarController@index
Route::get('/navbar', [NavbarController::class, 'index']);

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


// Rute untuk menampilkan halaman Top Seller
Route::get('/top-seller', [ProductController::class, 'topSellers'])->name('products.top');

// Rute API yang akan dipanggil oleh JavaScript (Add to Cart dan Toggle Favorite)
Route::post('/api/cart/add', [ProductController::class, 'addToCart'])->name('products.add-to-cart');
Route::post('/api/products/favorite/toggle', [ProductController::class, 'toggleFavorite'])->name('products.toggle-favorite');

// Route untuk menampilkan halaman Detail Produk
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.detail');

// Rute Top Sellers yang sudah kita buat
Route::get('/top-sellers', [NavbarController::class, 'topSellers']); 

// Rute Add to Cart (yang dipanggil dari JS: '../cart/add_to_cart.php')
Route::post('/cart/add_to_cart.php', function() { 

// Di sini seharusnya memanggil CartController@addItem
return response()->json(['success' => true, 'cart_count' => 1]); 
});

// Rute Toggle Favorite (yang dipanggil dari JS: 'favorite_api.php')
Route::post('/favorite_api.php', function() { 
    // Di sini seharusnya memanggil FavoriteController@toggle
    // Placeholder: success = true agar JS tidak error
    return response()->json(['success' => true, 'fav_count' => 1]); 

    // Rute Add to Cart: Menggantikan route dummy sebelumnya
    Route::get('/discount', [DiscountController::class, 'index'])->name('discount.index');
  
});


// Route untuk Transaction History
Route::get('/transaction-history', [TransactionController::class, 'index'])->name('transaction.history');

// Halaman utama Management Stock & Harga
Route::get('/stock-management', [StockManagementController::class, 'index'])->name('stock.index');

// AJAX Endpoint untuk Tambah Stock
Route::post('/stock/add', [StockManagementController::class, 'updateStock'])->name('stock.updateStock');

// AJAX Endpoint untuk Ubah Harga/Diskon
Route::post('/stock/price', [StockManagementController::class, 'updatePrice'])->name('stock.updatePrice');

// Pastikan rute utama (/) terdaftar. Ini akan menampilkan home_discount.blade.php
Route::get('/', [DiscountController::class, 'index'])->name('discount.index');

// Jika Anda sudah menambahkan rute produk:
Route::get('/products', [DiscountController::class, 'products'])->name('discount.products');

// Rute ini juga memanggil method index() dan menggunakan nama yang sama
Route::get('/discount', [DiscountController::class, 'index'])->name('discount.index');

// Rute BARU untuk Best Sellers
Route::get('/best-sellers', [BestSellerController::class, 'index'])->name('product.best_sellers');

// API untuk Add to Cart (menggantikan ../cart/add_to_cart.php)
Route::post('/api/cart/add', [CartController::class, 'addToCart'])->name('cart.add'); 

// API untuk Favorite Toggle (menggantikan favorite_api.php)
Route::post('/api/favorite', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');

// Rute untuk halaman daftar semua kategori
Route::get('/shop-by-category', [CategoryController::class, 'index'])->name('categories.index');

// Rute untuk detail kategori (Kita akan buat ini di langkah selanjutnya)
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// Rute untuk halaman tim/perekrutan
Route::get('/about-team', [AboutController::class, 'team'])->name('about.team');

// Route untuk halaman footer
Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

//route footer
Route::get('/footer', [FooterController::class, 'index'])->name('footer');
Route::post('/footer/subscribe', [FooterController::class, 'subscribe'])->name('footer.subscribe');

//route payment
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');

//route FAQ
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::match(['get', 'post'], '/faq', [FaqController::class, 'index']);

//routw untuk halaman aboute us
Route::get('/aboutus', [AboutUsController::class, 'index'])->name('aboutus');