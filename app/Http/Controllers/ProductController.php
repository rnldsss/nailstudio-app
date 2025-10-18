<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // =================================================================
    // DUMMY NAV DATA HELPER (Untuk memastikan Navbar di TopSeller/Detail berfungsi)
    // =================================================================
    /**
     * Helper untuk membuat data dummy yang dibutuhkan oleh Navbar.
     * Dalam proyek nyata, ini akan diambil dari NavbarController atau Service.
     */
    private function getNavbarData()
    {
        // Data Kategori Dummy
        $categories = [
            ['name' => 'Nail Polish', 'url' => url('category/polish'), 'img' => 'https://storage.googleapis.com/a1aa/image/3454039a-1ec0-4d5b-d768-5eb40bc6fdf3.jpg', 'alt' => 'Nail Polish'],
            ['name' => 'Nail Tools', 'url' => url('category/tools'), 'img' => 'https://storage.googleapis.com/a1aa/image/19a38516-0222-4fe4-e0e8-8b6788672e73.jpg', 'alt' => 'Nail Tools'],
        ];

        // Data Badge & User Status Dummy
        $isLoggedIn = true; 
        $favCount = 3; 
        $totalItems = 5; 
        $profile_img = 'https://upload.wikimedia.org/wikipedia/commons/2/2c/Default_pfp.svg';

        return compact('categories', 'isLoggedIn', 'favCount', 'totalItems', 'profile_img');
    }

    // =================================================================
    // METHOD UNTUK TOP SELLER (Sudah Ada)
    // =================================================================
    public function topSellers()
    {
        // ... (Data Top Seller Anda) ...
        $topProducts = [
            // ... (Kode TopProducts Anda yang sebelumnya) ...
             [
                'id_product' => 1, 'namaproduct' => 'Laptop Gaming Terbaru RTX 4090', 'category' => 'Elektronik', 'price' => 25000000, 'status' => 'Available', 'image' => 'laptop-gaming-1.png', 'stock' => 5, 'total_sold' => 120,
            ],
            [
                'id_product' => 4, 'namaproduct' => 'Mouse Gaming Wireless Ultra Pro', 'category' => 'Aksesoris', 'price' => 550000, 'status' => 'Available', 'image' => 'mouse-gaming-4.png', 'stock' => 15, 'total_sold' => 65,
            ],
        ];
        $favIds = [1, 3]; 

        // Gabungkan data Top Seller dengan data Navbar
        $data = array_merge($this->getNavbarData(), [
            'topProducts' => $topProducts,
            'favIds' => $favIds,
        ]);
        
        // Mengirimkan data ke View 'top_seller'
        return view('top_seller', $data); // Ubah menjadi 'top_seller' jika Anda pindahkan file di luar folder 'zahara'
        // return view('zahara.top_seller', $data); // Gunakan ini jika file masih di folder 'zahara'
    }

    // =================================================================
    // METHOD BARU: DETAIL PRODUK
    // =================================================================
    /**
     * Menampilkan halaman Detail Produk.
     */
    public function show($id)
    {
        // DATA DUMMY: Menggantikan query SELECT * FROM product WHERE id = $id
        
        $product = [
            'id_product' => (int)$id, 
            'namaproduct' => 'Lip and Cheek Stain - Pink Glam',
            'category' => 'Makeup',
            'price' => 79000,
            'description' => 'Produk multifungsi yang dapat digunakan pada bibir dan pipi. Memberikan hasil akhir alami dengan daya tahan hingga 8 jam.',
            'image' => 'lip-stain.png', 
            'stock' => 12,
            'rating' => 4.5,
            'reviews_count' => 150,
            'variants' => [
                ['name' => 'Rose Red', 'stock' => 5],
                ['name' => 'Nude Peach', 'stock' => 7],
            ]
        ];
        
        $isFavorited = in_array((int)$id, [1, 5, 8]); 

        // Gabungkan data produk dengan data Navbar
        $data = array_merge($this->getNavbarData(), [
            'product' => $product,
            'isFavorited' => $isFavorited
        ]);
        
        // Mengirimkan data ke View 'detail_product'
        return view('detail_product', $data);
    }
    
    // =================================================================
    // METHOD UNTUK API (Sudah Ada)
    // =================================================================
    public function addToCart(Request $request)
    {
        return response()->json(['success' => true, 'message' => 'Produk berhasil ditambahkan ke keranjang.', 'cart_count' => 3 ]);
    }

    public function toggleFavorite(Request $request)
    {
        $action = $request->input('action'); 
        return response()->json(['success' => true, 'message' => 'Status favorit berhasil diubah.', 'fav_count' => ($action == 'add') ? 3 : 2 ]);
    }
}