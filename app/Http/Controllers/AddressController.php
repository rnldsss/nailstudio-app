<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller untuk halaman manajemen alamat.
 *
 * Halaman ini menampilkan daftar alamat pengguna serta form untuk
 * menambahkan alamat baru. Data alamat disediakan sebagai array
 * statis. Untuk aplikasi produksi, Anda sebaiknya menggunakan
 * model Eloquent untuk mengambil dan menyimpan data.
 */
class AddressController extends Controller
{
    /**
     * Menghasilkan data navbar dummy.
     *
     * @return array
     */
    private function getNavbarData()
    {
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
     * Menampilkan daftar alamat pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Daftar alamat dummy
        $addresses = [
            ['id' => 1, 'address' => 'Jl. Telekomunikasi', 'type' => 'shipping'],
            ['id' => 2, 'address' => 'Jl. Mawar',          'type' => 'shipping'],
            ['id' => 3, 'address' => 'Jl. Sukapura No.10', 'type' => 'shipping'],
        ];

        $data = array_merge($this->getNavbarData(), [
            'addresses' => $addresses,
        ]);

        return view('pages.address', $data);
    }
}