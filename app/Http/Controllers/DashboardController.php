<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private function getDummyOrders()
    {
        return [
            ['id' => 121, 'fullname' => 'Rizkia', 'order_status' => 'Processing', 'order_date' => '2025-10-17', 'file_path' => 'bukti_transfer_121.jpg', 'barang' => ['VINTAGE MAUVEx2', 'DIY NAIL ART'], 'harga' => ['Rp 15.000.000', 'Rp 500.000'], 'total' => 30500000],
            ['id' => 122, 'fullname' => 'Putri', 'order_status' => 'Shipped', 'order_date' => '2025-10-16', 'file_path' => null, 'barang' => ['FRENCH NAILS'], 'harga' => ['Rp 10.000.000'], 'total' => 10000000],
            ['id' => 123, 'fullname' => 'Siti Aisyah', 'order_status' => 'Pending', 'order_date' => '2025-10-17', 'file_path' => 'bukti_transfer_123.png', 'barang' => ['DREAMY TIPS', 'BLUSH PETAL'], 'harga' => ['Rp 800.000', 'Rp 1.200.000'], 'total' => 3600000],
            ['id' => 124, 'fullname' => 'Susilawati', 'order_status' => 'Completed', 'order_date' => '2025-10-15', 'file_path' => 'bukti_transfer_124.jpg', 'barang' => ['NAIL FLAIR'], 'harga' => ['Rp 50.000'], 'total' => 250000],
        ];
    }

    public function index()
    {
        $orders = $this->getDummyOrders();
        $total_login = 55; $total_register = 12;
        $total_sales = collect($orders)->where('order_status', 'Completed')->sum('total');

        return view('admin/dashboard', compact('orders', 'total_login', 'total_register', 'total_sales'));
    }

    public function updateStatus(Request $request)
    {
        // Simulasi Update
        return redirect()->route('dashboard.index')->with('success', 'Status pesanan berhasil diupdate (Simulasi).');
    }
    
    public function showDetail($id)
    {
        $order = collect($this->getDummyOrders())->firstWhere('id', (int)$id);

        if (!$order) { return redirect()->route('dashboard.index')->with('error', 'Order ID not found.'); }

        $items = [];
        $total_items = 0;
        foreach ($order['barang'] as $index => $item_desc) {
            $price_text = $order['harga'][$index];
            $price_raw = (int) filter_var($price_text, FILTER_SANITIZE_NUMBER_INT);
            $item_name = $item_desc;
            $qty = 1;
            if (preg_match('/(.*)\sx(\d+)$/', $item_desc, $matches)) { $item_name = trim($matches[1]); $qty = (int)$matches[2]; }
            $total_items += $qty;
            $items[] = ['namaproduct' => $item_name, 'qty' => $qty, 'price' => $price_raw];
        }
        $order['total_items'] = $total_items;
        $order['username'] = $order['fullname']; // Tambahkan username/fullname untuk view detail

        return view('admin/detail-order', compact('order', 'items'));
    }
}
