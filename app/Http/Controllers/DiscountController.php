<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DiscountController extends Controller
{
    public function index()
    {
        // Assuming your view is resources/views/discount.blade.php
        return view('discount'); 
    }
}