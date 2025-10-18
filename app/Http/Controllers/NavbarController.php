<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NavbarController extends Controller
{
    // Fungsi untuk mengambil data navbar (Fav count, cart count, categories)
    private function getNavbarData()
    {
        // 1. Inisialisasi data
        $totalItems = 0;
        $favCount = 0;
        $profile_img = 'https://upload.wikimedia.org/wikipedia/commons/2/2c/Default_pfp.svg';
        
        // Asumsi Session 'id' atau 'user_id'
        $isLoggedIn = Session::has('id') || Session::has('user_id');

        if ($isLoggedIn) {
            // --- DATA DUMMY UNTUK ASSESSMENT ---
            // Nanti, Anda harus mengganti bagian ini dengan logika koneksi database Eloquent Model
            $totalItems = 5; 
            $favCount = 3;   
            
            $user_photo_session = Session::get('user_photo'); 
            
            $profile_img = $user_photo_session
                ? asset('uploads/' . $user_photo_session)
                : 'https://upload.wikimedia.org/wikipedia/commons/2/2c/Default_pfp.svg';
        }
        
        // 2. Data Kategori
        $categories = [
            // Data Kategori dari kode PHP murni Anda
            [
                "name" => "Nail Polish",
                "img" => "https://storage.googleapis.com/a1aa/image/3454039a-1ec0-4d5b-d768-5eb40bc6fdf3.jpg",
                "alt" => "Classic manicure nails with red polish on a light pink background",
                "url" => url('products/nail-polish') // Menggunakan url() Laravel
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
     * Menampilkan halaman utama (index).
     */
    public function index()
    {
        // 1. Ambil data yang dibutuhkan dari fungsi di atas
        $data = $this->getNavbarData();
        
        // 2. Tampilkan view 'index' dan kirimkan data navbar
        return view('index', $data);
    }
}
