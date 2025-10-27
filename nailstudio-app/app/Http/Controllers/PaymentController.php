<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller untuk halaman informasi pembayaran.
 *
 * Halaman ini menampilkan cara menggunakan metode pembayaran QRIS secara
 * bertahap.  Data yang dibutuhkan diambil dari array statis sehingga
 * halaman ini dapat ditampilkan tanpa koneksi database.  Contoh ini
 * mengikuti gaya codingan dari repository dengan menyiapkan data dalam
 * array dan meneruskannya ke view menggunakan fungsi compact().
 */
class PaymentController extends Controller
{
    /**
     * Tampilkan halaman info pembayaran.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Judul dan pengantar untuk halaman
        $title = "Nail Art Studio";
        $intro = "Nail Art Studio is thrilled to introduce our new appointment and design selection system! Booking your perfect nail style has never been easier.";

        // Data langkah pembayaran QRIS, disusun sebagai array of arrays
        $steps = [
            [
                'number' => 1,
                'title' => 'Select your nail art design',
                'content' => 'Browse through our creative collection or work with our experts to create a custom nail art design. Pick the style that fits your personality best.'
            ],
            [
                'number' => 2,
                'title' => 'Book your appointment',
                'content' => 'Choose a date and time that suits you. Our friendly and professional team will take care of the rest, ensuring you receive top-notch service and beautiful results.'
            ],
            [
                'number' => 3,
                'title' => 'Confirm payment details',
                'content' => 'Review the payment amount and merchant details in your app, then confirm the transaction using your PIN, fingerprint, or face recognition.'
            ],
            [
                'number' => 4,
                'title' => 'Payment complete!',
                'content' => 'Your payment is processed instantly. You\'ll receive a confirmation notification and can proceed with your order immediately.'
            ],
        ];

        // Return the payment view with the data
        return view('pages.payment', compact('title', 'intro', 'steps'));
    }
}