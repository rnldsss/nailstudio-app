<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// use App\Models\Product; // Dihapus untuk menggunakan data dummy
// use App\Models\Favorite; // Dihapus untuk menggunakan data dummy

class NavbarController extends Controller
{
    /**
     * Mengambil data yang dibutuhkan untuk navbar dan header.
     * @return array
     */
    private function getNavbarData()
    {
        // 1. Inisialisasi data
        $totalItems = 0;
        $favCount = 0;
        $profile_img = 'https://upload.wikimedia.org/wikipedia/commons/2/2c/Default_pfp.svg';
        
        // Cek status login (Asumsi menggunakan session 'id' atau 'user_id')
        $isLoggedIn = Session::has('id') || Session::has('user_id');

        if ($isLoggedIn) {
            // --- DATA DUMMY (MENSIMULASIKAN HASIL DATABASE) ---
            $totalItems = 5; 
            $favCount = 3;   
            
            $user_photo_session = Session::get('user_photo'); 
            
            $profile_img = $user_photo_session
                ? asset('uploads/' . $user_photo_session) // Gunakan asset() Laravel
                : 'https://upload.wikimedia.org/wikipedia/commons/2/2c/Default_pfp.svg';
        }
        
        // 2. Data Kategori Navbar
        $categories = [
            [
                "name" => "Nail Polish",
                "img" => "https://storage.googleapis.com/a1aa/image/3454039a-1ec0-4d5b-d768-5eb40bc6fdf3.jpg",
                "alt" => "Classic manicure nails with red polish on a light pink background",
                "url" => url('products/nail-polish') 
            ],
            [
                "name" => "Nail Tools",
                "img" => "https://storage.googleapis.com/a1aa/image/19a38516-0222-4fe4-e0e8-8b6788672e73.jpg",
                "alt" => "Gel nails with shiny finish on a light pink background",
                "url" => url('products/nail-tools')
            ],
            [
                "name" => "Nail Care",
                "img" => "https://storage.googleapis.com/a1aa/image/795a778f-295f-402e-a035-64817b5dd80d.jpg",
                "alt" => "Nail art with floral and geometric designs on a light pink background",
                "url" => url('products/nail-care')
            ],
            [
                "name" => "Nail Art Kit",
                "img" => "https://storage.googleapis.com/a1aa/image/20882152-849e-49b3-885b-fbfe303673a2.jpg",
                "alt" => "Acrylic nails with glitter and rhinestones on a light pink background",
                "url" => url('products/nail-art-kit')
            ],
        ];

        return compact('totalItems', 'favCount', 'profile_img', 'categories', 'isLoggedIn');
    }

    /**
     * Metode index() untuk halaman utama (/) - Memanggil Navbar dan Top Sellers.
     */
    public function index()
    {
        // 1. Ambil data navbar
        $data = $this->getNavbarData();

        // 2. Ambil data Top Seller DUMMY (Minimal 10 item)
        $topSellers = [
            (object)['id_product' => 101, 'namaproduct' => 'VINTAGE MAUVE', 'price' => 78000, 'stock' => 32, 'image' => 'vintage_mauve.jpg', 'category' => 'Polish', 'status' => 'active'],
            (object)['id_product' => 102, 'namaproduct' => 'BLUSH PETAL', 'price' => 90000, 'stock' => 63, 'image' => 'blush_petal.jpg', 'category' => 'Polish', 'status' => 'active'],
            (object)['id_product' => 103, 'namaproduct' => 'NAIL NOURISH', 'price' => 16000, 'stock' => 48, 'image' => 'nail_nourish.jpg', 'category' => 'Care', 'status' => 'active'],
            (object)['id_product' => 104, 'namaproduct' => 'GLITTER POP', 'price' => 55000, 'stock' => 20, 'image' => 'glitter_pop.jpg', 'category' => 'Art', 'status' => 'active'],
            (object)['id_product' => 105, 'namaproduct' => 'CUTICLE OIL', 'price' => 25000, 'stock' => 90, 'image' => 'cuticle_oil.jpg', 'category' => 'Care', 'status' => 'active'],
            (object)['id_product' => 106, 'namaproduct' => 'MANICURE SET PRO', 'price' => 125000, 'stock' => 15, 'image' => 'manicure_set.jpg', 'category' => 'Tools', 'status' => 'active'],
            (object)['id_product' => 107, 'namaproduct' => 'ACRYLIC POWDER', 'price' => 88000, 'stock' => 40, 'image' => 'acrylic_powder.jpg', 'category' => 'Art', 'status' => 'active'],
            (object)['id_product' => 108, 'namaproduct' => 'BASE COAT MAX', 'price' => 62000, 'stock' => 75, 'image' => 'base_coat.jpg', 'category' => 'Polish', 'status' => 'active'],
            (object)['id_product' => 109, 'namaproduct' => 'UV LAMP MINI', 'price' => 150000, 'stock' => 10, 'image' => 'uv_lamp.jpg', 'category' => 'Tools', 'status' => 'active'],
            (object)['id_product' => 110, 'namaproduct' => 'GEL REMOVER', 'price' => 35000, 'stock' => 50, 'image' => 'gel_remover.jpg', 'category' => 'Care', 'status' => 'active'],
        ];
        
        // Gabungkan semua data (Navbar + Top Seller)
        $data['topSellers'] = $topSellers;
        $data['favIds'] = [102, 107]; // Asumsi ID favorit untuk index
        $data['user_id'] = 1; // Asumsi user login untuk View Top Seller
        
        // 3. Memanggil View 'index' (Master Layout)
        return view('index', $data);
    }
    
    /**
     * Menampilkan halaman produk Top Seller (Jika diakses via /top-sellers).
     */
    public function topSellers()
    {
        // Data Top Seller DUMMY yang sama
        $topProducts = [
            (object)['id_product' => 101, 'namaproduct' => 'VINTAGE MAUVE', 'price' => 78000, 'stock' => 32, 'image' => 'vintage_mauve.jpg', 'category' => 'Polish', 'status' => 'active'],
            (object)['id_product' => 102, 'namaproduct' => 'BLUSH PETAL', 'price' => 90000, 'stock' => 63, 'image' => 'blush_petal.jpg', 'category' => 'Polish', 'status' => 'active'],
            (object)['id_product' => 103, 'namaproduct' => 'NAIL NOURISH', 'price' => 16000, 'stock' => 48, 'image' => 'nail_nourish.jpg', 'category' => 'Care', 'status' => 'active'],
            (object)['id_product' => 104, 'namaproduct' => 'GLITTER POP', 'price' => 55000, 'stock' => 20, 'image' => 'glitter_pop.jpg', 'category' => 'Art', 'status' => 'active'],
            (object)['id_product' => 105, 'namaproduct' => 'CUTICLE OIL', 'price' => 25000, 'stock' => 90, 'image' => 'cuticle_oil.jpg', 'category' => 'Care', 'status' => 'active'],
            (object)['id_product' => 106, 'namaproduct' => 'MANICURE SET PRO', 'price' => 125000, 'stock' => 15, 'image' => 'manicure_set.jpg', 'category' => 'Tools', 'status' => 'active'],
            (object)['id_product' => 107, 'namaproduct' => 'ACRYLIC POWDER', 'price' => 88000, 'stock' => 40, 'image' => 'acrylic_powder.jpg', 'category' => 'Art', 'status' => 'active'],
            (object)['id_product' => 108, 'namaproduct' => 'BASE COAT MAX', 'price' => 62000, 'stock' => 75, 'image' => 'base_coat.jpg', 'category' => 'Polish', 'status' => 'active'],
            (object)['id_product' => 109, 'namaproduct' => 'UV LAMP MINI', 'price' => 150000, 'stock' => 10, 'image' => 'uv_lamp.jpg', 'category' => 'Tools', 'status' => 'active'],
            (object)['id_product' => 110, 'namaproduct' => 'GEL REMOVER', 'price' => 35000, 'stock' => 50, 'image' => 'gel_remover.jpg', 'category' => 'Care', 'status' => 'active'],
        ];
        
        $favIds = [102, 107];
        $user_id = 1;
        
        // Mengirim data ke View pages.top-sellers
        return view('pages.top-sellers', compact('topProducts', 'favIds', 'user_id'));
    }
}