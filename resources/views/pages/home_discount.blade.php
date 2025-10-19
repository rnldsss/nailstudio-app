@extends('layouts.discount') 

{{-- Menetapkan judul khusus untuk halaman ini --}}
@section('title', 'Nail Art Theme - Homepage Diskon')

@section('content')
    <div class="max-w-screen-2xl mx-auto px-4 py-10 md:py-16 py-8 bg-pink-100 p-4">
   
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
            <div>
                <h1 class="text-3xl md:text-4xl font-semibold leading-tight mb-4">
                    Discount nail art and
                    <br/>
                    cosmetics online
                </h1>
                <p class="text-sm md:text-base text-[#3B3B3B] mb-6 max-w-md">
                    Transform your nail art collection with genuine, discounted cosmetics and nail products from top
                    brands. Find your favourites and new treasures, all at exceptional prices.
                </p>
                <a href="{{ route('discount.index') }}">
    <button class="btn-pink text-white text-sm font-semibold px-5 py-2 rounded-md hover:bg-pink-700 transition" type="button">
        Shop sale now
    </button>
</a>
            </div>
            {{-- Image Cards --}}
            <div class="relative rounded-md overflow-hidden">
                <img alt="Nail art gift box" class="w-full h-auto object-cover rounded-md" height="250" src="https://storage.googleapis.com/a1aa/image/3727fd67-7ca1-42e4-c87c-081ec2cc631e.jpg" width="400"/>
                <a class="absolute top-3 right-3 bg-pink-600 text-white text-xs font-semibold px-3 py-1 rounded-bl-md flex items-center space-x-1" href="#">
                    <span>Shop Gift Packs</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="relative rounded-md overflow-hidden">
                <img alt="Nail polish bottle" class="w-full h-auto object-cover rounded-md" height="250" src="https://storage.googleapis.com/a1aa/image/e9c38cf2-114d-405d-f4d0-faa9dfff93bb.jpg" width="400"/>
                <a class="absolute top-3 right-3 bg-pink-600 text-white text-xs font-semibold px-3 py-1 rounded-bl-md flex items-center space-x-1" href="#">
                    <span>Shop Mother's Day</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Bagian Promosi yang Di-loop menggunakan data dari Controller --}}
    <div class="w-full border-t border-pink bg-pink-light py-4 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex space-x-8 text-pink-600 text-sm md:text-base font-semibold whitespace-nowrap scrolling-wrapper">
                
                {{-- Loop Pertama --}}
                @foreach ($promosi as $item)
                    <div class="flex items-center space-x-2">
                        <i class="{{ $item['icon'] }} text-lg"></i>
                        <span>{{ $item['text'] }}</span>
                    </div>
                @endforeach
                
                {{-- Loop Kedua (untuk efek scrolling) --}}
                @foreach ($promosi as $item)
                    <div class="flex items-center space-x-2">
                        <i class="{{ $item['icon'] }} text-lg"></i>
                        <span>{{ $item['text'] }}</span>
                    </div>
                @endforeach
                
            </div>
        </div>
    </div>

@endsection