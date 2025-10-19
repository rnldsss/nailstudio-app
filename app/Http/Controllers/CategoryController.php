<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Data kategori dummy yang dipakai di seluruh halaman kategori.
     */
    private function getCategories(): array
    {
        return [
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
    }

    /**
     * Menampilkan daftar semua kategori (Shop by Category).
     */
    public function index()
    {
        $categories = $this->getCategories();

        return view('pages.categories_list', compact('categories'));
    }

    /**
     * Menampilkan detail kategori dan produk rekomendasi.
     */
    public function show(string $slug)
    {
        $category = collect($this->getCategories())->firstWhere('slug', $slug);

        if (!$category) {
            abort(404);
        }

        $productsBySlug = [
            'nail-polish' => [
                [
                    'name' => 'Classic Pink Gloss',
                    'price' => 69000,
                    'image' => 'https://via.placeholder.com/240x240.png?text=Pink+Gloss',
                    'description' => 'Finishing glossy yang tahan lama untuk tampilan elegan setiap hari.',
                ],
                [
                    'name' => 'Sparkle Night Out',
                    'price' => 72000,
                    'image' => 'https://via.placeholder.com/240x240.png?text=Sparkle',
                    'description' => 'Pilihan glitter glamor untuk momen spesial yang memikat.',
                ],
            ],
            'nail-tools' => [
                [
                    'name' => 'Pro Manicure Kit',
                    'price' => 159000,
                    'image' => 'https://via.placeholder.com/240x240.png?text=Manicure+Kit',
                    'description' => 'Set lengkap alat manicure profesional untuk hasil salon di rumah.',
                ],
                [
                    'name' => 'Precision Nail File Set',
                    'price' => 45000,
                    'image' => 'https://via.placeholder.com/240x240.png?text=Nail+File',
                    'description' => 'Paket 3 nail file dengan grit berbeda untuk bentuk kuku sempurna.',
                ],
            ],
            'nail-care' => [
                [
                    'name' => 'Cuticle Care Oil',
                    'price' => 49000,
                    'image' => 'https://via.placeholder.com/240x240.png?text=Cuticle+Oil',
                    'description' => 'Nutrisi intensif untuk kuku dan kutikula agar tetap sehat dan kuat.',
                ],
                [
                    'name' => 'Keratin Nail Treatment',
                    'price' => 68000,
                    'image' => 'https://via.placeholder.com/240x240.png?text=Keratin+Treatment',
                    'description' => 'Formula keratin untuk memperbaiki kuku rapuh dan mudah patah.',
                ],
            ],
            'nail-art-kits' => [
                [
                    'name' => 'Beginner Nail Art Set',
                    'price' => 129000,
                    'image' => 'https://via.placeholder.com/240x240.png?text=Beginner+Kit',
                    'description' => 'Semua perlengkapan dasar untuk mulai berkreasi dengan nail art.',
                ],
                [
                    'name' => 'Deluxe Rhinestone Pack',
                    'price' => 89000,
                    'image' => 'https://via.placeholder.com/240x240.png?text=Rhinestones',
                    'description' => 'Koleksi rhinestone premium untuk desain kuku yang mewah dan unik.',
                ],
            ],
        ];

        $recommendedProducts = $productsBySlug[$slug] ?? [];

        return view('pages.category_detail', [
            'category' => $category,
            'recommendedProducts' => $recommendedProducts,
        ]);
    }
}
