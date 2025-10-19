<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller untuk halaman profil pengguna.
 *
 * Halaman ini memindahkan logic dari skrip PHP native ke dalam controller
 * Laravel agar lebih terstruktur dan mudah dipelihara. Data pengguna,
 * riwayat pesanan, dan alamat disiapkan sebagai array statis di sini.
 * Dalam implementasi nyata, data‑data ini sebaiknya diambil dari model
 * atau service layer.
 */
class ProfileController extends Controller
{
    /**
     * Menghasilkan data dummy untuk navbar. Dalam proyek nyata, data
     * ini kemungkinan besar diambil dari NavbarController atau service
     * terpisah. Disertakan di sini agar halaman profil tetap konsisten
     * dengan tampilan halaman lainnya.
     *
     * @return array
     */
    private function getNavbarData()
    {
        // Data kategori dummy
        $categories = [
            [
                'name' => 'Nail Polish',
                'url' => route('categories.show', ['slug' => 'nail-polish']),
                'img' => 'https://storage.googleapis.com/a1aa/image/3454039a-1ec0-4d5b-d768-5eb40bc6fdf3.jpg',
                'alt' => 'Nail Polish',
            ],
            [
                'name' => 'Nail Tools',
                'url' => route('categories.show', ['slug' => 'nail-tools']),
                'img' => 'https://storage.googleapis.com/a1aa/image/19a38516-0222-4fe4-e0e8-8b6788672e73.jpg',
                'alt' => 'Nail Tools',
            ],
        ];

        // Data status user dummy
        $isLoggedIn  = true;
        $favCount    = 3;
        $totalItems  = 2;
        $profile_img = 'https://upload.wikimedia.org/wikipedia/commons/2/2c/Default_pfp.svg';

        return compact('categories', 'isLoggedIn', 'favCount', 'totalItems', 'profile_img');
    }

    /**
     * Menampilkan halaman profil pengguna.
     *
     * Data pengguna, alamat, dan riwayat pemesanan diambil dari array
     * statis sebagai contoh. Anda dapat menggantinya dengan mengambil
     * data dari database menggunakan model.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Data pengguna dummy (contoh dari SQL nailstudio_db.sql)
        $user = [
            'username' => 'naillover',
            'fullname' => 'Nail Lover',
            'email'    => 'naillover@example.com',
            'photo'    => 'https://upload.wikimedia.org/wikipedia/commons/2/2c/Default_pfp.svg',
        ];

        // Daftar alamat dummy (shipping address)
        $addresses = [
            ['id' => 1, 'address' => 'Jl. Telekomunikasi',    'type' => 'shipping'],
            ['id' => 2, 'address' => 'Jl. Mawar',             'type' => 'shipping'],
            ['id' => 3, 'address' => 'Jl. Sukapura No.10',    'type' => 'shipping'],
        ];

        // Riwayat pemesanan dummy
        $orderHistory = [
            ['id' => 101, 'date' => '2025-06-01', 'status' => 'Completed', 'total' => '150000'],
            ['id' => 102, 'date' => '2025-06-15', 'status' => 'Processing', 'total' => '89000'],
        ];

        // Gabungkan data navbar dengan data halaman profil
        $data = array_merge($this->getNavbarData(), [
            'user'         => $user,
            'addresses'    => $addresses,
            'orderHistory' => $orderHistory,
        ]);

        return view('pages.profile', $data);
    }
}