@extends('layouts.base') {{-- Menggunakan layout yang netral --}}

@section('title', 'Beauty Secret - Join Our Team')

@section('content')

{{-- Bagian Hero / Perekrutan --}}
<div class="hero-container">
    <div class="max-w-screen-xl mx-auto px-6 md:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="flex flex-col max-w-xl text-center md:text-left">
                <h1 class="text-black text-3xl md:text-4xl font-semibold leading-snug mb-4">
                    Join Discovery Nail Art Studio
                </h1>
                <p class="text-[#1A1A1A] text-sm md:text-base font-normal mb-8 leading-relaxed">
                    We are looking for passionate and creative people to join our team. 
                    Enjoy a fun, professional workspace with training, growth opportunities, and great pay.
                </p>
                {{-- Mengubah link PHP native ke route Laravel --}}
                <a href="{{ url('lowongan.php') }}" class="self-center md:self-start">
                    <button class="bg-black text-white text-sm font-semibold rounded-md px-6 py-3 w-max hover:bg-gray-800 transition" type="button">
                        Apply Now
                    </button>
                </a>
            </div>

            <div class="rounded-xl overflow-hidden flex-shrink-0 w-full max-w-md md:w-[480px]">
                <img src="https://storage.googleapis.com/a1aa/image/13aae325-a01c-47aa-0420-4b0e1de34178.jpg"
                    alt="Models with colorful makeup"
                    class="w-full h-auto object-cover rounded-xl"
                    width="480" height="320"/>
            </div>
        </div>
    </div>
</div>

{{-- Bagian Meet Our Team --}}
<div class="bg-white py-16 px-4 md:px-12">
    <div class="max-w-screen-xl mx-auto">
        <h2 class="text-3xl font-semibold text-center mb-4">Meet Our Team</h2>
        <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">
            We are the creative minds behind this studio. Get to know the people who bring you the best services!
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Perulangan Blade untuk Menampilkan Anggota Tim --}}
            @foreach ($team_members as $member)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col transition-transform duration-300 hover:transform hover:-translate-y-2">
                    {{-- PENTING: Menggunakan data dan asset() yang dikirim dari Controller --}}
                    <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="w-full h-64 object-cover"/>
                    
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-semibold mb-1">{{ $member['name'] }}</h3>
                        <p class="text-sm text-pink-500 font-semibold mb-3">{{ $member['role'] }}</p>
                        
                        <p class="text-gray-600 flex-grow mb-4">{{ $member['desc'] }}</p>
                        
                        <a href="{{ $member['link'] }}" class="mt-auto inline-block bg-black text-white text-sm px-5 py-2.5 rounded-md hover:bg-gray-800 transition self-start">
                            View Profile
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection