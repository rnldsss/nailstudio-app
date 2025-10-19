<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Top Sellers Bulan Ini</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#eaf4fc] min-h-screen">

<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-[#eaf4fc]">
    <h2 class="text-center text-black text-2xl font-normal mb-6">Top Seller</h2>
    <div class="relative">
        <div class="flex overflow-x-auto scrollbar-hide gap-6 pb-4" style="scroll-snap-type: x mandatory;">

            {{-- Loop Blade untuk memanggil data dari Controller --}}
            @forelse ($topProducts as $product)
                @php
                    // Menggantikan logika PHP formatting:
                    // Asumsi: $product adalah objek (sesuai Controller dummy yang dibuat)
                    $imagePath = 'uploads/' . $product->image;
                    $imageURL = (!empty($product->image) && file_exists(public_path($imagePath)))
                        ? asset($imagePath) // Menggunakan asset() Laravel
                        : 'https://via.placeholder.com/160x160.png?text=No+Image';
                        
                    $productName = $product->namaproduct; 
                    $productPrice = number_format($product->price, 0, ',', '.');
                    $isFavorite = in_array($product->id_product, $favIds); 
                @endphp
                
                {{-- Struktur HTML Produk Card yang Sama --}}
                <div class="flex-none w-[300px] md:w-[320px] bg-white border border-gray-200 rounded-xl shadow p-6 flex flex-col scroll-snap-align-start">
                    <div class="flex justify-center mb-4 h-48">
                        <img src="{{ $imageURL }}" alt="{{ $productName }}" class="h-full w-auto object-contain rounded-lg"/>
                    </div>
                    
                    {{-- Nama Produk (Menggunakan notasi objek ->) --}}
                    <div class="mb-1 font-semibold text-gray-900 text-lg leading-snug">{{ $productName }}</div>
                    
                    {{-- Stok --}}
                    @if ($product->stock > 0)
                        <div class="mb-1 text-xs text-gray-500">Stok: {{ $product->stock }}</div>
                    @else
                        <div class="mb-1 text-xs text-gray-400 font-semibold">Stok Habis</div>
                    @endif
                    
                    {{-- Harga --}}
                    <div class="mb-4 text-gray-900 text-xl font-bold">Rp {{ $productPrice }}</div>
                    
                    <div class="flex gap-2 mt-auto">
                        <button class="flex-1 bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-lg font-semibold text-base whitespace-nowrap"
                            onclick="addToCart({{ $product->id_product }})" 
                            {{ $product->stock == 0 ? 'disabled style="opacity:0.6;cursor:not-allowed"' : '' }}>
                            Tambah ke Keranjang
                        </button>
                        
                        {{-- Tombol Favorite --}}
                        <button
                            class="w-14 flex items-center justify-center border border-gray-300 rounded-lg text-pink-600 hover:text-pink-800 transition favorite-btn"
                            data-product-id="{{ $product->id_product }}"
                            aria-label="{{ $isFavorite ? 'Hapus dari favorit' : 'Tambah ke favorit' }}"
                            title="{{ $isFavorite ? 'Hapus dari favorit' : 'Tambah ke favorit' }}"
                            {{ $product->stock == 0 ? 'disabled style="opacity:0.6;cursor:not-allowed"' : '' }}
                        >
                            <i class="{{ $isFavorite ? 'fas' : 'far' }} fa-heart text-2xl"></i>
                        </button>
                    </div>
                </div>

            @empty
                {{-- Tampilan jika data kosong --}}
                <div class="flex-none text-center w-full text-gray-600 py-12">Belum ada produk terlaris bulan ini.</div>
            @endforelse
        </div>
    </div>
</div>

{{-- Skrip JavaScript Anda (TETAP SAMA) --}}
<script>
    // Add to Cart tanpa alert apapun
    function addToCart(productId) {
      let fd = new FormData();
      fd.append('product_id', productId);
      // PENTING: Menggunakan URL Laravel yang sudah didaftarkan di routes/web.php
      fetch('{{ route('cart.add') }}', { 
        method: 'POST',
        body: fd
      })
      .then(res => res.json())
      .then(data => {
        // Fungsi ini harus ada di halaman yang memanggil Top Sellers (misal navbar)
        if(typeof updateCartBadge === "function") updateCartBadge(data.cart_count); 
        if(typeof openCartModal === "function") openCartModal();
      })
      .catch(err => {
        // console.error(err);
      });
    }

    // Toggle favorit
    document.querySelectorAll('.favorite-btn').forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        const pid = this.getAttribute('data-product-id');
        const icon = this.querySelector('i');
        const isFavorited = icon.classList.contains('fas');
        const action = isFavorited ? 'remove' : 'add';

        let fd = new FormData();
        fd.append('action', action);
        fd.append('product_id', pid);

        // PENTING: Menggunakan URL Laravel yang sudah didaftarkan di routes/web.php
        fetch('{{ route('favorite.toggle') }}', { 
          method: 'POST',
          body: fd
        })
        .then(res => res.text())
        .then(text => {
          try {
            const data = JSON.parse(text);
            if(data.success) {
              const favBadge = document.getElementById('favorite-badge');
              if(favBadge && data.fav_count !== undefined) favBadge.textContent = data.fav_count;
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
            }
          } catch (e) {
            // console.error(e);
          }
        })
        .catch(err => {
          // console.error(err);
        });
      });
    });
</script>
</body>
</html>
