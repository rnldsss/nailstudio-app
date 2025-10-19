<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        // Data FAQ dummy (karena tanpa database)
        $faqs = [
            [
                'question' => 'Bagaimana cara memesan layanan Nail Art?',
                'answer' => 'Anda dapat memesan layanan Nail Art melalui halaman booking atau langsung datang ke studio kami.'
            ],
            [
                'question' => 'Apakah produk yang digunakan aman?',
                'answer' => 'Kami hanya menggunakan produk berkualitas tinggi dan aman untuk semua jenis kulit.'
            ],
            [
                'question' => 'Berapa lama waktu pengerjaan Nail Art?',
                'answer' => 'Rata-rata pengerjaan memakan waktu sekitar 1-2 jam tergantung tingkat kesulitan desain.'
            ],
        ];

        // Pencarian sederhana
        $search = $request->query('q');
        if ($search) {
            $faqs = array_filter($faqs, function ($faq) use ($search) {
                return stripos($faq['question'], $search) !== false ||
                       stripos($faq['answer'], $search) !== false;
            });
        }

        // Status kirim pertanyaan (dummy)
        $success = null;
        $error = null;

        if ($request->isMethod('post')) {
            $question = trim($request->input('member_question'));
            if ($question !== '') {
                $success = 'Pertanyaan Anda berhasil dikirim! Admin akan segera menjawab.';
            } else {
                $error = 'Pertanyaan tidak boleh kosong.';
            }
        }

        return view('pages.faq', [
            'faqs' => $faqs,
            'search' => $search,
            'success' => $success,
            'error' => $error,
            'nama_user' => 'Guest',
        ]);
    }
}
