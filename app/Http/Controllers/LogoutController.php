<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LogoutController extends Controller
{
   public function logout(Request $request)
    {
        // 1. Menghapus semua variabel sesi dan menghancurkan sesi
        session()->flush(); 
        session()->regenerate(true); 

        // 2. Menghapus cookie yang mungkin ada
        // Cookie::forget() sekarang akan berfungsi karena sudah di-import.
        Cookie::forget('user_id'); 
        Cookie::forget('user_name');
        Cookie::forget('user_email');

        // 3. Redirect ke halaman login
        return redirect()->route('login');
    }
}
