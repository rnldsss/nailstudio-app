@extends('layouts.base') {{-- Menggunakan layout baru yang netral --}}

@section('title', 'Shop by category')

@section('content')
    <h1 class="text-3xl font-semibold text-center mb-8">
        Shop by category
    </h1>
    
    <section aria-label="Shop by category grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-6">
        
        @foreach ($categories as $category)
        <article class="flex flex-col items-center min-w-[240px]">
            <div class="rounded-lg overflow-hidden mb-3 w-[240px] h-[200px]">
                {{-- Menggunakan data dinamis dari Controller --}}
                <img alt="{{ $category['name'] }}" class="w-full h-full object-cover rounded-lg" height="200" src="{{ $category['image_url'] }}" width="240"/>
            </div>
            <h2 class="font-semibold text-lg mb-1 text-center">
                {{ $category['name'] }}
            </h2>
            <p class="text-sm text-gray-600 mb-2 leading-relaxed text-center">
                {{ $category['description'] }}
            </p>
            {{-- Menggunakan route named untuk link --}}
            <a class="text-xs font-semibold underline inline-block" href="{{ route('categories.show', ['slug' => $category['slug']]) }}">
                Shop {{ $category['name'] }}
            </a>
        </article>
        @endforeach
        
    </section>
@endsection



