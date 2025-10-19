<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Menampilkan halaman 'Join Our Team' dan 'Meet Our Team'.
     */
    public function team()
    {
        // Data Tim dipindahkan dari PHP native ke Controller
        $team_members = [
            [
                'name' => 'Raynaldi',
                'role' => 'Product Specialist',
                'image' => asset('images/ray.jpg'), 
                'desc' => 'Raynaldi is responsible for managing and developing products to stay outstanding and relevant in the market.',
                'link' => '#raynaldi'
            ],
            [
                'name' => 'Tazkya',
                'role' => 'Administrator',
                'image' => asset('images/tazkya.jpg'),
                'desc' => 'Tazkya manages all backend systems and ensures our daily operations run smoothly and efficiently.',
                'link' => '#tazkya'
            ],
            [
                'name' => 'Zahara',
                'role' => 'Landing Page Designer',
                'image' => asset('images/zahara.jpg'),
                'desc' => 'Zahara designs captivating landing pages to attract customers from the very first glance.',
                'link' => '#zahara'
            ],
        ];

        // MEMANGGIL NAMA VIEW YANG BARU: 'pages.ourTeam'
        return view('pages.about_team', compact('team_members'));
    }
}