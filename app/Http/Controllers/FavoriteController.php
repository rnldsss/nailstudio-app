<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth; // Diperlukan untuk user_id nyata

class FavoriteController extends Controller
{
    // Menangani permintaan AJAX dari tombol Hati (Wishlist)
    public function toggleFavorite(Request $request)
    {
        // 1. Ambil data dari request AJAX
        $productId = $request->input('product_id');
        $action = $request->input('action'); // 'add' atau 'remove'

        // 2. Simulasi Logika (di Laravel nyata, Anda akan menyimpan/menghapus dari database)
        if (!in_array($action, ['add', 'remove'])) {
             return response()->json(['success' => false, 'message' => 'Aksi tidak valid.'], 400);
        }

        // Logika nyata: Ambil user_id dari Auth::user()->id
        // Logika nyata: Jika action=='add', DB::table('favorite')->insert([...])
        // Logika nyata: Jika action=='remove', DB::table('favorite')->where(...)->delete()
        
        // SIMULASI BERHASIL
        $newFavCount = ($action == 'add') ? 3 : 2; // Contoh: hitungan favorit berubah
        
        return response()->json([
            'success' => true,
            'message' => 'Favorit berhasil diperbarui.',
            'fav_count' => $newFavCount
        ]);
    }
}
