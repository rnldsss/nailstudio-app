<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller untuk halaman pengaturan akun.
 *
 * Halaman ini memindahkan tampilan pengaturan akun dari script PHP
 * tradisional ke dalam struktur Laravel. Data pengguna ditetapkan
 * secara statis sebagai contoh dan dapat diganti dengan data dari
 * database melalui model.
 */
class AccountSettingsController extends Controller
{
    /**
     * Mengembalikan data navbar dummy agar konsisten dengan halaman lain.
     *
     * @return array
     */
    private function getNavbarData()
    {
        // Data kategori dan status login dummy
        $categories = [
            ['name' => 'Nail Polish', 'url' => route('categories.show', ['slug' => 'nail-polish']), 'img' => 'https://storage.googleapis.com/a1aa/image/3454039a-1ec0-4d5b-d768-5eb40bc6fdf3.jpg', 'alt' => 'Nail Polish'],
            ['name' => 'Nail Tools',  'url' => route('categories.show', ['slug' => 'nail-tools']),  'img' => 'https://storage.googleapis.com/a1aa/image/19a38516-0222-4fe4-e0e8-8b6788672e73.jpg', 'alt' => 'Nail Tools'],
        ];
        $isLoggedIn  = true;
        $favCount    = 3;
        $totalItems  = 2;
        $profile_img = 'https://upload.wikimedia.org/wikipedia/commons/2/2c/Default_pfp.svg';
        return compact('categories', 'isLoggedIn', 'favCount', 'totalItems', 'profile_img');
    }

    /**
     * Menampilkan halaman pengaturan akun.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Data pengguna dummy. Pada implementasi nyata, gunakan model untuk
        // mengambil data dari database.
        $user = [
            'username' => 'naillover',
            'fullname' => 'Nail Lover',
            'email'    => 'naillover@example.com',
        ];

        $data = array_merge($this->getNavbarData(), [
            'user' => $user,
        ]);

        return view('pages.account_settings', $data);
    }
}