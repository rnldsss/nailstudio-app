<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $title = "Nail Art Studio";
        $intro = "Nail Art Studio is thrilled to introduce our new appointment and design selection system! Booking your perfect nail style has never been easier.";
        $steps = [
            [
                "number" => 1,
                "title" => "Select your nail art design",
                "content" => "Browse through our creative collection or work with our experts to create a custom nail art design. Pick the style that fits your personality best."
            ],
            [
                "number" => 2,
                "title" => "Book your appointment",
                "content" => "Choose a date and time that suits you. Our friendly and professional team will take care of the rest, ensuring you receive top-notch service and beautiful results."
            ]
        ];

        return view('pages.payment', compact('title', 'intro', 'steps'));
    }
}

