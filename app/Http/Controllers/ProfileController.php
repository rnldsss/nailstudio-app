<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\View\Components\PageHeaders;

class ProfileController extends Controller
{
    /**
     * Prepare common navigation data for all pages
     *
     * @return array
     */
    private function prepareNavigationData()
    {
        return [
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
                    'active' => true
                ],
            ],
            'isLoggedIn' => true,
            'username' => 'zahara' // In a real app, get from auth()->user()->username
        ];
    }

    public function index()
    {
        // Share navigation data
        view()->share($this->prepareNavigationData());
        
        // Mock user data with formatting
        $userData = [
            'id' => 17,
            'username' => 'zahara',
            'email' => 'zaharaoyen@gmail.com',
            'photo' => null,
            'fullname' => 'Zahara',
            'created_at' => '2025-06-07',
            'status' => 'active'
        ];
        
        // Format date for user
        $user = $userData;
        $user['formatted_date'] = Carbon::parse($userData['created_at'])->format('d M Y');
        
        // Generate user photo URL
        $userPhotoUrl = $user['photo'] 
            ? asset('images/users/'.$user['photo'])
            : asset('images/avatar-placeholder.png');
        
        // Mock addresses data with formatting
        $rawAddresses = [
            [
                'id' => 3,
                'user_id' => 17,
                'address' => 'Jl. Sukapura No.10',
                'type' => 'shipping',
                'created_at' => '2025-06-16 01:46:14'
            ],
            [
                'id' => 4,
                'user_id' => 17,
                'address' => 'Jl. Sukabirus No.16',
                'type' => 'shipping',
                'created_at' => '2025-06-16 01:46:28'
            ],
            [
                'id' => 5,
                'user_id' => 17,
                'address' => 'Jl. Terusan Buah Batu',
                'type' => 'shipping',
                'created_at' => '2025-06-16 01:46:38'
            ]
        ];
        
        // Format address types for display
        $addresses = [];
        foreach ($rawAddresses as $address) {
            $address['type_display'] = ucfirst($address['type']);
            $addresses[] = $address;
        }
        
        $hasAddresses = count($addresses) > 0;
        
        // Mock orders data with formatting
        $rawOrders = [
            [
                'id' => 47,
                'user_id' => 17,
                'status' => '',
                'order_status' => 'Completed',
                'status_color' => 'success',
                'created_at' => '2025-06-16 01:55:24',
                'updated_at' => '2025-06-16 01:56:43',
                'total' => 78000,
                'item_count' => 1
            ],
            [
                'id' => 38,
                'user_id' => 17,
                'status' => '',
                'order_status' => 'Processing',
                'status_color' => 'primary',
                'created_at' => '2025-06-11 05:41:32',
                'updated_at' => '2025-06-16 01:53:58',
                'total' => 36000,
                'item_count' => 2
            ],
            [
                'id' => 37,
                'user_id' => 17,
                'status' => '',
                'order_status' => 'Completed',
                'status_color' => 'success',
                'created_at' => '2025-06-11 01:25:57',
                'updated_at' => '2025-06-11 05:35:48',
                'total' => 94000,
                'item_count' => 2
            ]
        ];
        
        // Format date and currency for orders
        $orders = [];
        foreach ($rawOrders as $order) {
            $formattedOrder = $order;
            $formattedOrder['formatted_date'] = Carbon::parse($order['created_at'])->format('d M Y H:i');
            $formattedOrder['formatted_total'] = 'Rp ' . number_format($order['total'], 0, ',', '.');
            $orders[] = $formattedOrder;
        }
        
        $hasOrders = count($orders) > 0;
        
        // Mock favorites data with formatting
        $rawFavorites = [
            [
                'id' => 21,
                'user_id' => 17,
                'product_id' => 24,
                'created_at' => '2025-06-16 01:48:14',
                'name' => 'BLUSH PETAL',
                'price' => 90000,
                'image' => '6832e7a9253c1.jpg'
            ],
            [
                'id' => 22,
                'user_id' => 17,
                'product_id' => 47,
                'created_at' => '2025-06-16 01:48:15',
                'name' => 'NAIL NOURISH',
                'price' => 16000,
                'image' => '683aae4a85103.jpg'
            ]
        ];
        
        // Format prices for favorites and prepare image URLs
        $favorites = [];
        foreach ($rawFavorites as $favorite) {
            $formattedFavorite = $favorite;
            $formattedFavorite['formatted_price'] = 'Rp ' . number_format($favorite['price'], 0, ',', '.');
            $formattedFavorite['image_url'] = asset('images/products/'.$favorite['image']);
            $favorites[] = $formattedFavorite;
        }
        
        $hasFavorites = count($favorites) > 0;
        
        return view('profile.index', compact(
            'user', 
            'userPhotoUrl',
            'addresses', 
            'hasAddresses', 
            'orders', 
            'hasOrders', 
            'favorites', 
            'hasFavorites'
        ));
    }
    
    public function edit()
    {
        // Share navigation data
        view()->share($this->prepareNavigationData());
        
        // Logic for retrieving user data would go here
        $user = [
            'id' => 17,
            'username' => 'zahara',
            'email' => 'zaharaoyen@gmail.com',
            'photo' => null,
            'fullname' => 'Zahara',
            'created_at' => '2025-06-07',
            'status' => 'active'
        ];
        
        $userPhotoUrl = $user['photo'] 
            ? asset('images/users/'.$user['photo'])
            : asset('images/avatar-placeholder.png');
            
        return view('profile.edit', compact('user', 'userPhotoUrl'));
    }
    
    public function update(Request $request)
    {
        // In a real app, validate and save user data here
        // Redirect with success message
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully');
    }
    
    public function changePassword()
    {
        // Share navigation data
        view()->share($this->prepareNavigationData());
        
        return view('profile.change-password');
    }
    
    public function updatePassword(Request $request)
    {
        // In a real app, validate passwords and update here
        // Redirect with success message
        return redirect()->route('profile.index')->with('success', 'Password changed successfully');
    }
}