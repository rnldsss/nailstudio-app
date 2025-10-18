<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Menangani permintaan AJAX POST untuk menambah produk ke keranjang.
     * Menggantikan logika '../cart/add_to_cart.php'.
     */
    public function addItem(Request $request)
    {
        // 1. Validasi Input (Pastikan product_id terkirim)
        $request->validate(['product_id' => 'required|integer']);

        // 2. Cek Status Login (Penting: Logika ini ada di JS Anda)
        $user_id = Session::get('id') ?? Session::get('user_id');

        if (!$user_id) {
            // Mengembalikan respons error 401 jika user belum login
            return response()->json(['success' => false, 'message' => 'User must be logged in.'], 401);
        }

        $productId = $request->input('product_id');

        // --- SIMULASI LOGIKA CART DI DATABASE (DUMMY) ---
        
        // Di sini seharusnya ada:
        // 1. Mencari atau membuat Cart aktif untuk $user_id.
        // 2. Mencari CartItem untuk $productId.
        // 3. Menambah qty atau membuat CartItem baru.
        // 4. Menghitung total item baru.
        
        // Total item yang dikembalikan: DUMMY
        $newCartCount = 7; 

        // 3. Mengembalikan respons yang diharapkan JavaScript (success: true)
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully.',
            'cart_count' => $newCartCount
        ]);
    }
}
