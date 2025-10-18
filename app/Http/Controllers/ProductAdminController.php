<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductAdminController extends Controller
{
    private function getDummyProducts()
    {
        return [
            ['id_product' => 101, 'namaproduct' => 'Gel Nail Polish Set A', 'category' => 'Gel Polish', 'stock' => 50, 'price' => 250000, 'discount' => 10, 'status' => 'published', 'added' => '2025-05-10 10:00:00', 'image' => 'polish_set_a.jpg'],
            ['id_product' => 102, 'namaproduct' => 'UV Lamp Pro 54W', 'category' => 'Equipment', 'stock' => 5, 'price' => 850000, 'discount' => 0, 'status' => 'low stock', 'added' => '2025-09-20 12:30:00', 'image' => 'uv_lamp_pro.jpg'],
            ['id_product' => 103, 'namaproduct' => 'Cuticle Oil Pen', 'category' => 'Tools', 'stock' => 0, 'price' => 50000, 'discount' => 0, 'status' => 'draft', 'added' => '2025-10-15 09:00:00', 'image' => 'cuticle_oil.jpg'],
        ];
    }

    public function index()
    {
        $products = $this->getDummyProducts();
        $formattedProducts = [];

        foreach ($products as $row) {
            $discount = $row['discount']; 
            $price = $row['price'];
            $discountedPrice = $price - ($price * ($discount / 100));

            switch ($row['status']) {
                case 'published': $statusClass = 'status-published'; $statusText = 'Published'; break;
                case 'low stock': $statusClass = 'status-low'; $statusText = 'Low Stock'; break;
                default: $statusClass = 'status-draft'; $statusText = 'Draft'; break;
            }

            $formattedProducts[] = [
                'id' => $row['id_product'],
                'name' => $row['namaproduct'],
                'category' => $row['category'],
                'stock' => $row['stock'],
                'price' => number_format($price, 0, ',', '.'),
                'discount' => $discount,
                'price_discounted' => number_format($discountedPrice, 0, ',', '.'),
                'status_class' => $statusClass,
                'status_text' => $statusText,
                'added_date' => date('d M Y', strtotime($row['added'])),
                'image' => $row['image'],
            ];
        }

        return view('admin/product', ['formattedProducts' => $formattedProducts, 'success' => session('success'), 'error' => session('error')]);
    }
    
    public function create() { return view('product.create'); }
    public function store(Request $request) { return redirect()->route('product.index')->with('success', 'Product added (Simulasi)!'); }
    public function edit($id) { return view('product.edit', compact('id')); }
    public function destroy($id) { return redirect()->route('product.index')->with('success', 'Product deleted (Simulasi)!'); }

}
