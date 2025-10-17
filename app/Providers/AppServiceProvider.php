<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Default values for navigation data if none is provided
        View::composer('*', function ($view) {
            if (!isset($view->getData()['menuItems'])) {
                $view->with([
                    'menuItems' => [
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
                    ],
                    'isLoggedIn' => false,
                    'username' => ''
                ]);
            }
        });
    }
}