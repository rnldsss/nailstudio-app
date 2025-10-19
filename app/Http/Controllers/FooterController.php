<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        // Menampilkan halaman footer
        return view('pages.footer');
    }

    public function subscribe(Request $request)
    {
        // Simulasi validasi email tanpa database
        $email = $request->input('email');

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('message', 'success');
        } else {
            return redirect()->back()->with('message', 'invalid_email');
        }
    }
}
