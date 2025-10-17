<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    // Prepare menu data
    $menuItems = [
        [
            'route' => 'home',
            'label' => 'Home',
            'active' => true
        ],
        [
            'route' => 'products.index',
            'label' => 'Products',
            'active' => false
        ],
        [
            'route' => 'profile.index',
            'label' => 'Profile',
            'active' => false
        ],
    ];
    
    view()->share([
        'menuItems' => $menuItems,
        'isLoggedIn' => true,
        'username' => 'zahara'
    ]);
    
    return view('welcome');
})->name('home');

// Profile Routes
Route::prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::put('/update', [ProfileController::class, 'update'])->name('update');
    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('change-password');
    Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('update-password');
    
    // Address routes
    Route::prefix('addresses')->name('addresses.')->group(function () {
        Route::get('/create', function () { 
            $menuItems = [
                [
                    'route' => 'home',
                    'label' => 'Home',
                    'active' => false
                ],
                [
                    'route' => 'products.index',
                    'label' => 'Products',
                    'active' => false
                ],
                [
                    'route' => 'profile.index',
                    'label' => 'Profile',
                    'active' => true
                ],
            ];
            
            view()->share([
                'menuItems' => $menuItems,
                'isLoggedIn' => true,
                'username' => 'zahara'
            ]);
            
            return view('profile.addresses.create'); 
        })->name('create');
        
        Route::get('/{id}/edit', function ($id) { 
            $menuItems = [
                [
                    'route' => 'home',
                    'label' => 'Home',
                    'active' => false
                ],
                [
                    'route' => 'products.index',
                    'label' => 'Products',
                    'active' => false
                ],
                [
                    'route' => 'profile.index',
                    'label' => 'Profile',
                    'active' => true
                ],
            ];
            
            view()->share([
                'menuItems' => $menuItems,
                'isLoggedIn' => true,
                'username' => 'zahara'
            ]);
            
            return view('profile.addresses.edit', ['id' => $id]); 
        })->name('edit');
        
        Route::get('/{id}/delete', function ($id) { return back(); })->name('delete');
    });
    
    // Orders routes
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/{id}', function ($id) { 
            $menuItems = [
                [
                    'route' => 'home',
                    'label' => 'Home',
                    'active' => false
                ],
                [
                    'route' => 'products.index',
                    'label' => 'Products',
                    'active' => false
                ],
                [
                    'route' => 'profile.index',
                    'label' => 'Profile',
                    'active' => true
                ],
            ];
            
            view()->share([
                'menuItems' => $menuItems,
                'isLoggedIn' => true,
                'username' => 'zahara'
            ]);
            
            return view('profile.orders.detail', ['id' => $id]); 
        })->name('detail');
    });
    
    // Favorites routes
    Route::prefix('favorites')->name('favorites.')->group(function () {
        Route::get('/{id}/remove', function ($id) { return back(); })->name('remove');
    });
});

// Product Routes (placeholder for now)
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', function () { 
        $menuItems = [
            [
                'route' => 'home',
                'label' => 'Home',
                'active' => false
            ],
            [
                'route' => 'products.index',
                'label' => 'Products',
                'active' => true
            ],
            [
                'route' => 'profile.index',
                'label' => 'Profile',
                'active' => false
            ],
        ];
        
        view()->share([
            'menuItems' => $menuItems,
            'isLoggedIn' => true,
            'username' => 'zahara'
        ]);
        
        return view('products.index'); 
    })->name('index');
    
    Route::get('/{id}', function ($id) { 
        $menuItems = [
            [
                'route' => 'home',
                'label' => 'Home',
                'active' => false
            ],
            [
                'route' => 'products.index',
                'label' => 'Products',
                'active' => true
            ],
            [
                'route' => 'profile.index',
                'label' => 'Profile',
                'active' => false
            ],
        ];
        
        view()->share([
            'menuItems' => $menuItems,
            'isLoggedIn' => true,
            'username' => 'zahara'
        ]);
        
        return view('products.show', ['id' => $id]); 
    })->name('show');
});

// Authentication Routes (placeholder for now)
Route::get('/login', function () { 
    $menuItems = [
        [
            'route' => 'home',
            'label' => 'Home',
            'active' => false
        ],
        [
            'route' => 'products.index',
            'label' => 'Products',
            'active' => false
        ],
        [
            'route' => 'profile.index',
            'label' => 'Profile',
            'active' => false
        ],
    ];
    
    view()->share([
        'menuItems' => $menuItems,
        'isLoggedIn' => false,
        'username' => ''
    ]);
    
    return view('auth.login'); 
})->name('login');

Route::get('/register', function () { 
    $menuItems = [
        [
            'route' => 'home',
            'label' => 'Home',
            'active' => false
        ],
        [
            'route' => 'products.index',
            'label' => 'Products',
            'active' => false
        ],
        [
            'route' => 'profile.index',
            'label' => 'Profile',
            'active' => false
        ],
    ];
    
    view()->share([
        'menuItems' => $menuItems,
        'isLoggedIn' => false,
        'username' => ''
    ]);
    
    return view('auth.register'); 
})->name('register');

Route::get('/logout', function () { return redirect('/'); })->name('logout');