@extends('layouts.discount')

@section('title', 'Produk Paling Laris (Best Sellers)')

@section('content')

<div class="max-w-7xl mx-auto py-14 px-6 bg-pink-100 rounded-2xl shadow-lg">
    <div class="flex flex-col md:flex-row md:space-x-12 mb-10">
        <div class="flex flex-col justify-center mb-8 md:mb-0 md:w-1/4">
            <h2 class="text-black text-3xl font-semibold leading-snug mb-8 max-w-xs">
                Shop<br/> Our Best Sellers
            </h2>
            <a href="{{ url('nowShop.php') }}" class="bg-black text-white text-base font-semibold rounded-lg px-6 py-3 w-max inline-block hover:bg-gray-800 transition">
                Shop sale now
            </a>
        </div>

        <div class="md:w-3/4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

                @foreach ($products as $product)
                    @php
                        $imagePath = 'uploads/' . $product['image'];
                        $imageURL = asset($imagePath);
                        if (!file_exists(public_path($imagePath))) {
                            $imageURL = 'https://via.placeholder.com/300x300.png?text=No+Image';
                        }
                        $productName = htmlspecialchars($product['namaproduct']);
                        $productPrice = number_format($product['price'], 0, ',', '.');
                        $isFavorite = in_array($product['id_product'], $favIds);
                    @endphp

                    <div class="border border-gray-200 rounded-xl p-6 flex flex-col bg-white shadow-lg relative hover:shadow-2xl transition duration-200 transform hover:-translate-y-1">
                        {{-- Label Best Seller --}}
                        <span class="absolute top-3 left-3 bg-pink-600 text-white text-sm font-semibold px-3 py-1 rounded-full shadow">
                            Best Seller
                        </span>
                        
                        <div class="flex justify-center mb-5 h-56 overflow-hidden rounded-lg">
                            <img src="{{ $imageURL }}" alt="{{ $productName }}" class="h-full w-auto object-contain transition-transform duration-300 hover:scale-105"/>
                        </div>
                        
                        <p class="text-gray-600 text-sm font-semibold mb-1">{{ htmlspecialchars($product['category']) }}</p>
                        
                        <div class="mb-2 font-semibold text-gray-900 text-lg leading-snug flex-grow">{{ $productName }}</div>
                        
                        @if ($product['stock'] > 0)
                            <div class="mb-1 text-sm text-gray-500">Stok: {{ $product['stock'] }}</div>
                        @else
                            <div class="mb-1 text-sm text-red-500 font-semibold">Stok Habis</div>
                        @endif
                        
                        <div class="flex items-center space-x-2 mb-4 text-gray-900 text-xl font-bold">Rp {{ $productPrice }}</div>
                        
                        <div class="flex gap-2 mt-auto">
                            <button class="flex-1 bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-lg font-semibold add-to-cart-btn transition" data-product-id="{{ $product['id_product'] }}">
                                Tambah ke Keranjang
                            </button>
                            
                            <button
                                class="w-12 flex items-center justify-center border border-gray-300 rounded-lg text-pink-600 hover:text-pink-800 transition favorite-btn"
                                data-product-id="{{ $product['id_product'] }}"
                                aria-label="{{ $isFavorite ? 'Hapus dari favorit' : 'Tambah ke favorit' }}"
                                title="{{ $isFavorite ? 'Hapus dari favorit' : 'Tambah ke favorit' }}"
                            >
                                <i class="{{ $isFavorite ? 'fas' : 'far' }} fa-heart text-xl"></i>
                            </button>
                        </div>
                    </div>
                @endforeach

                @if (count($products) == 0)
                    <div class="w-full text-center text-gray-400 py-16 col-span-4 text-lg">Belum ada produk terlaris bulan ini.</div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    const initialFavCount = {{ $favCount ?? 0 }};
    const favBadge = document.getElementById('favorite-badge');
    if(favBadge && favBadge.textContent.trim() === '') {
         favBadge.textContent = initialFavCount;
    }

    // Add to Cart
    document.querySelectorAll('.add-to-cart-btn').forEach(function(btn){
        btn.addEventListener('click', function(){
            let productId = btn.getAttribute('data-product-id');
            let fd = new FormData();
            fd.append('product_id', productId);
            
            fetch('{{ route("cart.add") }}', { 
                method: 'POST',
                body: fd
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    if(typeof updateCartBadge === "function") updateCartBadge(data.cart_count);
                    if(typeof openCartModal === "function") openCartModal();
                } else {
                    alert('Gagal menambah ke keranjang! ' + (data.message || ''));
                }
            })
            .catch(err => alert('Terjadi error pada koneksi! ' + err));
        });
    });

    // Wishlist/Favorite toggle
    document.querySelectorAll('.favorite-btn').forEach(function(btn){
        btn.addEventListener('click', function(e){
            e.preventDefault();
            const pid = btn.getAttribute('data-product-id');
            const icon = btn.querySelector('i');
            const isFavorited = icon.classList.contains('fas');
            const action = isFavorited ? 'remove' : 'add';

            let fd = new FormData();
            fd.append('action', action);
            fd.append('product_id', pid);

            fetch('{{ route("favorite.toggle") }}', { 
                method: 'POST',
                body: fd
            })
            .then(res => res.text())
            .then(text => {
                try {
                    const data = JSON.parse(text);
                    if(data.success) {
                        if(action === 'add') {
                            icon.classList.remove('far');
                            icon.classList.add('fas');
                            btn.setAttribute('title', 'Hapus dari favorit');
                            btn.setAttribute('aria-label', 'Hapus dari favorit');
                        } else {
                            icon.classList.remove('fas');
                            icon.classList.add('far');
                            btn.setAttribute('title', 'Tambah ke favorit');
                            btn.setAttribute('aria-label', 'Tambah ke favorit');
                        }
                        const favBadge = document.getElementById('favorite-badge');
                        if(favBadge && data.fav_count !== undefined) favBadge.textContent = data.fav_count;
                    } else {
                        alert('Gagal update favorit: ' + (data.message || ''));
                    }
                } catch (e) {
                    alert('Response bukan JSON valid:\n' + text);
                }
            })
            .catch(err => alert('Error jaringan: ' + err));
        });
    });
</script>

@endsection
