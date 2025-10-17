<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Data dummy untuk simulasi hasil query database
    private function getDummyOrders()
    {
        return [
            [
                'id' => 121,
                'fullname' => 'Rizky Fadillah',
                'order_status' => 'Processing',
                'order_date' => '2025-10-17',
                'file_path' => 'bukti_transfer_121.jpg', 
                'barang' => ['Laptop Gaming x2', 'Mouse Wireless'],
                'harga' => ['Rp 15.000.000', 'Rp 500.000'],
                'total' => 30500000,
            ],
            [
                'id' => 122,
                'fullname' => 'Budi Santoso',
                'order_status' => 'Shipped',
                'order_date' => '2025-10-16',
                'file_path' => null, 
                'barang' => ['Smartphone Pro'],
                'harga' => ['Rp 10.000.000'],
                'total' => 10000000,
            ],
            [
                'id' => 123,
                'fullname' => 'Siti Aisyah',
                'order_status' => 'Pending',
                'order_date' => '2025-10-17',
                'file_path' => 'bukti_transfer_123.png',
                'barang' => ['Keyboard Mekanik x3', 'Headset Gaming'],
                'harga' => ['Rp 800.000', 'Rp 1.200.000'],
                'total' => 3600000,
            ],
            [
                'id' => 124,
                'fullname' => 'Joko Susilo',
                'order_status' => 'Completed',
                'order_date' => '2025-10-15',
                'file_path' => 'bukti_transfer_124.jpg',
                'barang' => ['Flashdisk 64GB x5'],
                'harga' => ['Rp 50.000'],
                'total' => 250000,
            ],
        ];
    }

    // Method untuk menampilkan halaman dashboard (GET)
    public function index()
    {
        $orders = $this->getDummyOrders();
        $total_login = 55;
        $total_register = 12;

        $total_sales = collect($orders)
                        ->where('order_status', 'Completed')
                        ->sum('total');

        return view('admin/dashboard', [
            'orders' => $orders,
            'total_login' => $total_login,
            'total_register' => $total_register,
            'total_sales' => $total_sales,
        ]);
    }

    // Method untuk mengupdate status order (POST) - Simulasi update
    public function updateStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'new_status' => 'required|string|in:Pending,Processing,Shipped,Completed',
        ]);
        
        // Simulasi update berhasil
        return redirect()->route('dashboard.index')->with('success', 'Status pesanan berhasil diupdate (Simulasi).');
    }
}
