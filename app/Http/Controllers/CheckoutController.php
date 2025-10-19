<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller untuk halaman checkout.
 *
 * Halaman ini menampilkan daftar item yang ada di keranjang, menghitung
 * subtotal setelah diskon, serta menampilkan daftar alamat pengiriman.
 * Data disediakan sebagai array statis yang meniru hasil query ke
 * database. Pada aplikasi sebenarnya, logic perhitungan dan pengambilan
 * data akan dipindahkan ke model atau service terpisah.
 */
class CheckoutController extends Controller
{
    /**
     * Data navbar dummy untuk konsistensi tampilan.
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
     * Menampilkan halaman checkout.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Data item keranjang dummy
        $cartItems = [
            [
                'namaproduct' => 'Nail Polish Set',
                'qty'        => 2,
                'price'      => 90000,
                'discount'   => 10,
            ],
            [
                'namaproduct' => 'Nail Art Brush',
                'qty'        => 1,
                'price'      => 45000,
                'discount'   => 0,
            ],
        ];

        // Hitung subtotal setelah diskon
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $priceAfterDiscount = $item['price'] * (1 - $item['discount'] / 100);
            $subtotal += $priceAfterDiscount * $item['qty'];
        }

        // Daftar alamat dummy
        $addresses = [
            ['id' => 1, 'address' => 'Jl. Telekomunikasi', 'type' => 'shipping'],
            ['id' => 2, 'address' => 'Jl. Mawar',          'type' => 'shipping'],
            ['id' => 3, 'address' => 'Jl. Sukapura No.10', 'type' => 'shipping'],
        ];

        $data = array_merge($this->getNavbarData(), [
            'cartItems' => $cartItems,
            'subtotal'  => $subtotal,
            'addresses' => $addresses,
        ]);

        return view('pages.checkout', $data);
    }
}