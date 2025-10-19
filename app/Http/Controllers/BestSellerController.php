<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Dalam proyek nyata, Anda akan menggunakan Session Laravel, bukan PHP native
// use Illuminate\Support\Facades\Session; 
// use Illuminate\Support\Facades\DB; // Untuk menjalankan query SQL

class BestSellerController extends Controller
{
    public function index()
    {
        // ---------------------------------------------------------------------
        // SIMULASI LOGIKA PHP & DATABASE DI DALAM CONTROLLER
        // Dalam proyek SI nyata: Gunakan Model Eloquent/DB::select()
        // ---------------------------------------------------------------------
        
        // --- 1. Simulasi Koneksi Database dan Sesi ---
        // Asumsikan koneksi database ($conn) sudah diinisialisasi di Laravel
        // $user_id = Session::get('user_id') ?? null;
        $user_id = 1; // Contoh: ID user dummy
        
        // --- 2. Data Produk Best Seller (Hasil Query Anda) ---
        // Karena tidak bisa connect database, kita gunakan data dummy yang kompleks
        
        $products = [
            // Ini adalah data produk yang sudah difilter dan di-loop per kategori
            [
                'id_product' => 101, 
                'namaproduct' => 'Top Coat Kilau Abadi (Best)', 
                'stock' => 50, 
                'price' => 75000, 
                'status' => 'published', 
                'image' => 'nail_product_01.jpg',
                'category' => 'Top Coat', 
                'total_sold' => 35
            ],
            [
                'id_product' => 102, 
                'namaproduct' => 'Cat Kuku Gel Merah Ruby', 
                'stock' => 10, 
                'price' => 95000, 
                'status' => 'low stock', 
                'image' => 'nail_product_02.jpg',
                'category' => 'Gel Polish', 
                'total_sold' => 45
            ],
            [
                'id_product' => 103, 
                'namaproduct' => 'Set Stiker Kuku Edisi Floral', 
                'stock' => 0, // Akan ditandai "Stok Habis"
                'price' => 35000, 
                'status' => 'published', 
                'image' => 'nail_product_03.jpg',
                'category' => 'Nail Art Kit', 
                'total_sold' => 28
            ],
            [
                'id_product' => 104, 
                'namaproduct' => 'Kuas Detail Art (Terlaris)', 
                'stock' => 20, 
                'price' => 45000, 
                'status' => 'published', 
                'image' => 'nail_product_04.jpg',
                'category' => 'Tools', 
                'total_sold' => 52
            ]
        ];
        
        // --- 3. Data Favorit User (Wishlist) ---
        // Hasil dari query SELECT product_id FROM favorite WHERE user_id = ?
        $favIds = [102, 104]; // Contoh: User ini suka produk 102 dan 104
        $favCount = count($favIds);

        // ---------------------------------------------------------------------
        
        // Mengirim SEMUA DATA yang dibutuhkan ke View
        return view('pages.best_sellers', compact('products', 'favIds', 'favCount'));
    }
}