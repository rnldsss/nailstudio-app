<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountController extends Controller
{
   public function index()
    {
        // Data yang akan ditampilkan secara dinamis di view
        $promosi = [
            ['icon' => 'far fa-clock', 'text' => 'Fast Delivery'],
            ['icon' => 'fas fa-hand-sparkles', 'text' => 'Genuine Nail Art Products'],
            ['icon' => 'far fa-star', 'text' => 'Google Trusted Store'],
            ['icon' => 'fas fa-map-marker-alt', 'text' => 'Australian Owned'],
            ['icon' => 'fas fa-box-open', 'text' => 'Free Shipping'],
            ['icon' => 'fas fa-headset', 'text' => 'Customer Support'],
        ];

        // KODE YANG SUDAH DIKOREKSI:
        // Cukup gunakan nama folder (pages) titik (.) nama file (home_discount)
        return view('pages.home_discount', compact('promosi'));
    }
}
