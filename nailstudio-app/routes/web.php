<?php

use Illuminate\Support\Facades\Route;

// Import controllers used throughout the application.
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\BestSellerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FaqMessageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StockManagementController;
use App\Http\Controllers\TransactionController;

// Import our newly created controllers for profile and related pages.
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Landing pages and static sections
Route::get('/', [NavbarController::class, 'index'])->name('home');
Route::get('/top-sellers', [NavbarController::class, 'topSellers'])->name('products.top');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Product and category pages
Route::get('/discount', [DiscountController::class, 'index'])->name('discount.index');
Route::get('/best-sellers', [BestSellerController::class, 'index'])->name('product.best_sellers');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.detail');

// Cart and favorite APIs (placeholder responses)
Route::post('/api/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/api/favorite', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');
Route::any('/cart/cart_api.php', function () {
    return response()->json(['success' => true, 'message' => 'Placeholder cart API response.']);
});
Route::any('/cart/get_cart.php', function () {
    return '<div class="text-center text-gray-500 py-4">Cart content placeholder.</div>';
});
Route::post('/favorite_api.php', function () {
    return response()->json(['success' => true, 'fav_count' => 0]);
});

// Category listing
Route::get('/shop-by-category', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// About pages
Route::get('/about-team', [AboutController::class, 'team'])->name('about.team');
Route::get('/aboutus', [AboutUsController::class, 'index'])->name('aboutus');

// Payment info page
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');

// Footer subscription
Route::get('/footer', [FooterController::class, 'index'])->name('footer');
Route::post('/footer/subscribe', [FooterController::class, 'subscribe'])->name('footer.subscribe');

// FAQ pages
Route::match(['get', 'post'], '/faq', [FaqController::class, 'index'])->name('faq');

// Admin and dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::post('/dashboard/update-status', [DashboardController::class, 'updateStatus'])->name('dashboard.updateStatus');

// Product admin CRUD
Route::get('/product', [ProductAdminController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductAdminController::class, 'create'])->name('product.create');
Route::post('/product/store', [ProductAdminController::class, 'store'])->name('product.store');
Route::get('/product/edit/{id}', [ProductAdminController::class, 'edit'])->name('product.edit');
Route::delete('/product/destroy/{id}', [ProductAdminController::class, 'destroy'])->name('product.destroy');

// Analytics
Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

// Admin FAQ
Route::get('/admin/faq', [FaqMessageController::class, 'index'])->name('admin.faq.index');
Route::post('/admin/faq/submit', [FaqMessageController::class, 'submitAnswer'])->name('admin.faq.submit');

// Transaction history
Route::get('/transaction-history', [TransactionController::class, 'index'])->name('transaction.history');

// Stock management
Route::get('/stock-management', [StockManagementController::class, 'index'])->name('stock.index');
Route::post('/stock/add', [StockManagementController::class, 'updateStock'])->name('stock.updateStock');
Route::post('/stock/price', [StockManagementController::class, 'updatePrice'])->name('stock.updatePrice');

// --------------------------------------------------------------------------
// User profile related routes
//
// The following routes handle the user profile and checkout flow.  They point
// to the controllers created specifically for this conversion from native
// PHP pages to Laravel Blade.  Each controller returns an array of data
// instead of making direct database queries.
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/account-settings', [AccountSettingsController::class, 'index'])->name('account.settings');
Route::get('/address', [AddressController::class, 'index'])->name('address.index');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');