<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Session; // Diperlukan untuk logika keranjang nyata

class CartController extends Controller
{
    // Menangani permintaan AJAX dari "Tambah ke Keranjang"
    public function addToCart(Request $request)
    {
        // 1. Ambil data product_id dari request AJAX
        $productId = $request->input('product_id');

        // 2. Simulasi Logika (di Laravel nyata, Anda akan menambahkan item ke sesi atau database)
        if (empty($productId)) {
            return response()->json([
                'success' => false,
                'message' => 'ID produk tidak ditemukan.'
            ], 400); 
        }

        // SIMULASI BERHASIL
        // Logika nyata: Session::push('cart', $productId);
        // Logika nyata: $cartCount = count(Session::get('cart', []));
        
        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang!',
            'cart_count' => 1 // Ganti dengan hitungan keranjang yang sebenarnya
        ]);
    }
}