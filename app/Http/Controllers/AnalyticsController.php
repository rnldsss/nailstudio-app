<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    // Simulasi hasil query dari database
    private function getDummyData()
    {
        // 1. SALES ANALYTICS (Simulasi 12 bulan)
        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $penjualan = [
            15000000, 22000000, 18000000, 35000000, 42000000, 50000000,
            48000000, 55000000, 60000000, 65000000, 70000000, 85000000 // Simulasi kenaikan
        ];

        // 2. VISITOR STATISTICS (Simulasi 7 hari: Mon, Tue, ..., Sun)
        $visitor_day = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $visitor_count = [
            250, 300, 280, 400, 550, 650, 350 // Jumlah pengunjung
        ];

        // 3. PRODUCT PERFORMANCE (Top 4 produk terlaris)
        $product_label = ['Gel Polish A', 'UV Lamp', 'Cuticle Oil', 'Buffer Set'];
        $product_qty = [150, 80, 50, 30];

        // 4. ORDER STATUS (Simulasi 4 status utama)
        $all_status = ['Completed', 'Pending', 'Processing', 'Cancelled'];
        $status_count = [
            'Completed' => 450, 
            'Pending' => 80, 
            'Processing' => 120, 
            'Cancelled' => 15
        ];

        return [
            'bulan' => $bulan,
            'penjualan' => $penjualan,
            'visitor_day' => $visitor_day,
            'visitor_count' => $visitor_count,
            'product_label' => $product_label,
            'product_qty' => $product_qty,
            'all_status' => array_keys($status_count),
            'status_count' => array_values($status_count)
        ];
    }

    public function index()
    {
        $data = $this->getDummyData();
        
        // Kirim semua array yang sudah diproses ke View
        return view('admin/analytics', $data);
    }
}
