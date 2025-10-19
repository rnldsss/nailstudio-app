@extends('layouts.base')

@section('title', $category['name'] . ' Collection')

@section('content')
    <section class="max-w-5xl mx-auto py-10">
        <header class="mb-8 text-center">
            <h1 class="text-3xl font-semibold text-gray-900">{{ $category['name'] }}</h1>
            <p class="mt-3 text-gray-600 max-w-3xl mx-auto">
                {{ $category['description'] }}
            </p>
        </header>

        <div class="rounded-xl overflow-hidden shadow-lg mb-10">
            <img
                src="{{ $category['image_url'] }}"
                alt="{{ $category['name'] }}"
                class="w-full h-64 object-cover"
            >
        </div>

        <section>
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">
                Rekomendasi Produk
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($recommendedProducts as $product)
                    <article class="border border-gray-200 rounded-xl shadow-sm overflow-hidden bg-white">
                        <div class="h-48 bg-gray-100 flex items-center justify-center">
                            <img
                                src="{{ $product['image'] }}"
                                alt="{{ $product['name'] }}"
                                class="h-full w-full object-cover"
                            >
                        </div>
                        <div class="p-5 flex flex-col gap-2">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $product['name'] }}</h3>
                            <p class="text-sm text-gray-600">{{ $product['description'] }}</p>
                            <span class="text-pink-600 font-semibold text-base">
                                Rp {{ number_format($product['price'], 0, ',', '.') }}
                            </span>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </section>
@endsection
