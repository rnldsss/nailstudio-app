<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqMessageController extends Controller
{
    private function getDummyFaqs()
    {
        return [
            [
                'id' => 1, 
                'user_id' => 101, 
                'question' => 'Bagaimana cara mengganti warna kuku setelah pembelian?', 
                'answer' => 'Anda bisa menggunakan fitur palet warna yang tersedia di halaman akun Anda.', 
                'status' => 'answered', 
                'created_at' => '2025-10-15 10:00:00'
            ],
            [
                'id' => 2, 
                'user_id' => 105, 
                'question' => 'Apakah produk ini tahan air?', 
                'answer' => null, 
                'status' => 'pending', 
                'created_at' => '2025-10-16 11:30:00'
            ],
            [
                'id' => 3, 
                'user_id' => 102, 
                'question' => 'Berapa lama waktu pengiriman ke luar Jawa?', 
                'answer' => null, 
                'status' => 'pending', 
                'created_at' => '2025-10-17 08:45:00'
            ],
        ];
    }

    /**
     * Menampilkan daftar pertanyaan dari member.
     */
    public function index()
    {
        // 2. Ambil semua pertanyaan dari user (mensimulasikan ORDER BY created_at DESC)
        $faqs = collect($this->getDummyFaqs())->sortByDesc('created_at')->toArray();
        
        // Simulasikan pesan sukses dari session
        $success = session('success');

        return view('admin/faq', compact('faqs', 'success'));
    }

    /**
     * Proses submit jawaban admin (POST).
     * Mensimulasikan UPDATE faq_questions dan INSERT INTO faq.
     */
    public function submitAnswer(Request $request)
    {
        $request->validate([
            'faq_id' => 'required|integer',
            'answer' => 'required|string|min:5',
        ]);
        
        $faq_id = $request->faq_id;
        $answer = $request->answer;

        // --- SIMULASI LOGIKA DATABASE ---
        
        // 1. Simulasi UPDATE faq_questions (Set status='answered')
        // (Di Laravel, Anda akan menggunakan Eloquent di sini: FaqQuestion::find($faq_id)->update(['answer' => $answer, 'status' => 'answered']))

        // 2. Simulasi Ambil pertanyaan (question) yang baru dijawab
        //    (Di sini kita asumsikan data yang dibutuhkan sudah ada/diambil)
        $simulated_question = "Apakah produk ini tahan air?"; // Ambil question dari DB

        // 3. Simulasi Cek dan Tambahkan ke tabel FAQ publik
        // (Di Laravel, Anda akan menggunakan DB::table('faq')->updateOrInsert(...) atau Transaction)
        
        // --- END SIMULASI ---

        // Setelah update dan insert (simulasi), redirect dengan pesan sukses
        return redirect()->route('admin.faq.index')->with('success', 'Jawaban berhasil dipublish & ditambahkan ke FAQ (Simulasi DB).');
    }
}
