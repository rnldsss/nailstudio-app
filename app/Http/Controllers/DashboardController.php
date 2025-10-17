<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Data dummy untuk simulasi hasil query database
    private function getDummyOrders()
    {
        // ... (data dummy Anda yang panjang) ...
        return [
            // ... (data dummy) ... 
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

    public function index()
    {
        $orders = $this->getDummyOrders();
        $total_login = 55; $total_register = 12;

        $total_sales = collect($orders)
                        ->where('order_status', 'Completed')
                        ->sum('total');

        return view('admin/dashboard', [ // Ini mengacu ke resources/views/dashboard.blade.php
            'orders' => $orders,
            'total_login' => $total_login,
            'total_register' => $total_register,
            'total_sales' => $total_sales,
        ]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'new_status' => 'required|string|in:Pending,Processing,Shipped,Completed',
        ]);
        
        return redirect()->route('dashboard.index')->with('success', 'Simulasi Status pesanan berhasil diupdate.');
    }
}
