<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar semua kategori (Shop by Category).
     */
    public function index()
    {
        // Data Kategori Dibuat di Controller (Menggantikan hardcoded HTML)
        $categories = [
            [
                'name' => 'Nail Polish',
                'description' => 'Discover a wide range of vibrant nail polish colors to express your style and keep your nails looking flawless.',
                'image_url' => 'https://storage.googleapis.com/a1aa/image/79af7731-bbca-4ecf-81ab-89b4fc60ba09.jpg',
                'slug' => 'nail-polish' // Digunakan untuk link
            ],
            [
                'name' => 'Nail Tools',
                'description' => 'Equip yourself with professional nail art tools to create stunning designs and perfect manicures at home.',
                'image_url' => 'https://storage.googleapis.com/a1aa/image/00ca869f-b79f-4eba-4496-3cb3d6a437e2.jpg',
                'slug' => 'nail-tools'
            ],
            [
                'name' => 'Nail Care',
                'description' => 'Keep your nails healthy and strong with our selection of nourishing nail care products.',
                'image_url' => 'https://storage.googleapis.com/a1aa/image/ee2168e9-fe2f-42e0-f9d2-a3e2439bca5c.jpg',
                'slug' => 'nail-care'
            ],
            [
                'name' => 'Nail Art Kits',
                'description' => 'Everything you need in one kit to create beautiful and professional nail art designs.',
                'image_url' => 'https://storage.googleapis.com/a1aa/image/ddb074b7-db74-4545-4e0d-b21d818f5dac.jpg',
                'slug' => 'nail-art-kits'
            ],
        ];

        return view('pages.categories_list', compact('categories'));
    }
}
