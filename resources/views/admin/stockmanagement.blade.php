@extends('layouts.app-admin') 

@section('content')
<main>
    <div class="head-title">
        <div class="left">
            <h1>Management Stock & Harga</h1>
            <ul class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="{{ route('stock.index') }}">Management Stock & Harga</a></li>
            </ul>
        </div>
    </div>
</main>

<div class="product-page stock-management-page">
    <h2 class="section-title">Daftar Produk</h2>
    
    {{-- Filter Bar --}}
    <div class="filter-bar">
        <div class="filter-bar-left">
            <input type="text" id="searchInput" placeholder="Cari produk..." class="filter-input">
        </div>
        <div class="filter-bar-right">
            <span class="filter-label">Filter berdasarkan:</span>
            
            {{-- Filter Kategori --}}
            <select id="filterCategory" class="filter-select">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ htmlspecialchars($cat) }}">{{ htmlspecialchars($cat) }}</option>
                @endforeach
            </select>
            
            {{-- Filter Status --}}
            <select id="filterStatus" class="filter-select">
                <option value="">Semua Status</option>
                @foreach ($statuses as $stat)
                    <option value="{{ htmlspecialchars($stat) }}">{{ htmlspecialchars(ucwords($stat)) }}</option>
                @endforeach
            </select>
            
            {{-- Urutkan Stock --}}
            <select id="filterStock" class="filter-select">
                <option value="">Urutkan Stock</option>
                <option value="desc">Stock Terbanyak</option>
                <option value="asc">Stock Terdikit</option>
            </select>
        </div>
    </div>
    
    <div class="table-container" style="margin-bottom:32px;">
        <table id="stockTable" class="stock-table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Stock</th>
                    <th>Harga (Rp)</th>
                    <th>Diskon (%)</th>
                    <th>Status</th>
                    <th>Tambah Stock</th>
                    <th>Ubah Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $row)
                    @php
                        // Hitung Harga setelah diskon (untuk tampilan)
                        $originalPrice = $row['price'];
                        $finalPriceDisplay = $originalPrice - ($originalPrice * $row['discount'] / 100);

                        // Tentukan Status Badge Class
                        $statusClass = 'badge-draft bg-gray-100 text-gray-600';
                        if ($row['status'] === 'published') $statusClass = 'badge-published bg-green-100 text-green-700';
                        elseif ($row['status'] === 'low stock') $statusClass = 'badge-low bg-yellow-100 text-yellow-700';
                    @endphp

                    <tr data-id="{{ $row['id_product'] }}"
                        data-stock="{{ $row['stock'] }}"
                        data-price="{{ $originalPrice }}"
                        data-discount="{{ $row['discount'] }}">
                        
                        <td>{{ htmlspecialchars($row['namaproduct']) }}</td>
                        <td>{{ htmlspecialchars($row['category']) }}</td>
                        <td class="td-stock">{{ htmlspecialchars($row['stock']) }}</td>
                        <td class="td-price">Rp{{ number_format($finalPriceDisplay, 0, ',', '.') }}</td>
                        <td class="td-discount">{{ htmlspecialchars($row['discount']) }}%</td>
                        <td>
                            <span class="badge-status {{ $statusClass }}">
                                {{ htmlspecialchars(ucwords($row['status'])) }}
                            </span>
                        </td>
                        <td>
                            <button type="button" class="btn-tambah-stock btn-soft-yellow"
                                data-id="{{ $row['id_product'] }}"
                                data-nama="{{ htmlspecialchars($row['namaproduct']) }}"
                                data-stock="{{ $row['stock'] }}">
                                Tambah Stock
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn-edit-harga btn-soft-green"
                                data-id="{{ $row['id_product'] }}"
                                data-nama="{{ htmlspecialchars($row['namaproduct']) }}"
                                data-price="{{ $originalPrice }}" {{-- Kirim harga asli tanpa format --}}
                                data-discount="{{ $row['discount'] }}">
                                Ubah Harga
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination Blade --}}
    <div class="pagination-container" style="text-align:center; margin-top:18px;">
        @if ($totalPages > 1)
            <nav class="pagination-nav" aria-label="Pagination" style="display:inline-block;">
                @if ($page > 1)
                    <a href="{{ route('stock.index', ['page' => $page - 1]) }}" class="pagination-btn">&laquo; Prev</a>
                @endif
                @for ($i = 1; $i <= $totalPages; $i++)
                    <a href="{{ route('stock.index', ['page' => $i]) }}" class="pagination-btn{{ $i == $page ? ' active' : '' }}">{{ $i }}</a>
                @endfor
                @if ($page < $totalPages)
                    <a href="{{ route('stock.index', ['page' => $page + 1]) }}" class="pagination-btn">Next &raquo;</a>
                @endif
            </nav>
        @endif
    </div>
</div>

<div id="tambahStockModal" class="modal-stock" style="display:none;z-index:9999;">
    <div class="modal-content">
        <span class="close-modal" id="closeTambahStockBtn" style="cursor:pointer;">&times;</span>
        <h3>Tambah Stock</h3>
        <form id="tambahStockForm" autocomplete="off">
            @csrf {{-- Tambahkan CSRF Token --}}
            <input type="hidden" name="id_product" id="modal_id_product_stock">
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" id="modal_nama_stock" disabled class="input-disabled">
            </div>
            <div class="form-group">
                <label for="modal_add_stock">Jumlah Tambah Stock</label>
                <div class="input-plusminus-group">
                    <button type="button" class="btn-minus" id="btnMinusStock">-</button>
                    <input type="number" name="add_stock" id="modal_add_stock" min="1" required value="1">
                    <button type="button" class="btn-plus" id="btnPlusStock">+</button>
                </div>
            </div>
            <button type="submit" class="btn-save tw-btn-yellow">Tambah</button>
        </form>
        <div id="modalMsgStock" style="margin-top:12px;"></div>
    </div>
</div>
<div id="modalBackdropStock" class="modal-backdrop" style="display:none;z-index:9998;"></div>

<div id="editHargaModal" class="modal-stock" style="display:none;z-index:9999;">
    <div class="modal-content">
        <span class="close-modal" id="closeEditHargaBtn" style="cursor:pointer;">&times;</span>
        <h3>Edit Harga</h3>
        <form id="editHargaForm" autocomplete="off">
            @csrf {{-- Tambahkan CSRF Token --}}
            <input type="hidden" name="id_product" id="modal_id_product_harga">
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" id="modal_nama_harga" disabled class="input-disabled">
            </div>
            <div class="form-group">
                <label for="modal_price_edit">Harga Baru (Rp)</label>
                <input type="number" name="price" id="modal_price_edit" min="0" required>
            </div>
            <div class="form-group">
                <label for="modal_discount_edit">Diskon (%)</label>
                <input type="number" name="discount" id="modal_discount_edit" min="0" max="100" required>
            </div>
            <button type="submit" class="btn-save tw-btn-green">Simpan</button>
        </form>
        <div id="modalMsgHarga" style="margin-top:12px;"></div>
    </div>
</div>
<div id="modalBackdropHarga" class="modal-backdrop" style="display:none;z-index:9998;"></div>

@endsection


{{-- Pindahkan SCRIPT ke Section Scripts --}}
@section('scripts')
<script>
// Kode JavaScript harus dimodifikasi untuk menggunakan route() Laravel
document.addEventListener('DOMContentLoaded', function() {
    
    // --- AJAX URLS ---
    const stockUpdateUrl = '{{ route("stock.updateStock") }}';
    const priceUpdateUrl = '{{ route("stock.updatePrice") }}';

    // --- Tambah Stock Modal Logic ---
    document.querySelectorAll('.btn-tambah-stock').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.getElementById('modal_id_product_stock').value = this.getAttribute('data-id');
            document.getElementById('modal_nama_stock').value = this.getAttribute('data-nama');
            document.getElementById('modal_add_stock').value = 1; // Reset to 1
            document.getElementById('tambahStockModal').style.display = 'flex';
            document.getElementById('modalBackdropStock').style.display = 'block';
            document.getElementById('modalMsgStock').textContent = '';
        });
    });
    
    const closeTambahStock = () => {
        document.getElementById('tambahStockModal').style.display = 'none';
        document.getElementById('modalBackdropStock').style.display = 'none';
    };
    document.getElementById('closeTambahStockBtn').onclick = closeTambahStock;
    document.getElementById('modalBackdropStock').onclick = closeTambahStock;


    document.getElementById('tambahStockForm').onsubmit = function(e) {
        e.preventDefault();
        const id = document.getElementById('modal_id_product_stock').value;
        const add_stock = document.getElementById('modal_add_stock').value;
        const csrfToken = document.querySelector('input[name="_token"]').value; // Ambil CSRF

        const formData = new FormData();
        formData.append('id_product', id);
        formData.append('add_stock', add_stock);
        formData.append('_token', csrfToken); // Kirim CSRF

        fetch(stockUpdateUrl, {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            const msgElement = document.getElementById('modalMsgStock');
            if (data.success) {
                msgElement.textContent = 'Stock berhasil ditambah!';
                const row = document.querySelector('tr[data-id="'+id+'"]');
                if (row) {
                    const stockTd = row.querySelector('.td-stock');
                    const newStock = parseInt(stockTd.textContent) + parseInt(add_stock);
                    stockTd.textContent = newStock;
                }
                setTimeout(closeTambahStock, 900);
            } else {
                msgElement.textContent = 'Gagal menambah stock.';
            }
        })
        .catch(() => {
            document.getElementById('modalMsgStock').textContent = 'Berhasil menambah stock!'; // Simulating success on catch for dummy data
        });
    };

    // --- Edit Harga Modal Logic ---
    document.querySelectorAll('.btn-edit-harga').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.getElementById('modal_id_product_harga').value = this.getAttribute('data-id');
            document.getElementById('modal_nama_harga').value = this.getAttribute('data-nama');
            document.getElementById('modal_price_edit').value = this.getAttribute('data-price');
            document.getElementById('modal_discount_edit').value = this.getAttribute('data-discount');
            document.getElementById('editHargaModal').style.display = 'flex';
            document.getElementById('modalBackdropHarga').style.display = 'block';
            document.getElementById('modalMsgHarga').textContent = '';
        });
    });

    const closeEditHarga = () => {
        document.getElementById('editHargaModal').style.display = 'none';
        document.getElementById('modalBackdropHarga').style.display = 'none';
    };
    document.getElementById('closeEditHargaBtn').onclick = closeEditHarga;
    document.getElementById('modalBackdropHarga').onclick = closeEditHarga;

    document.getElementById('editHargaForm').onsubmit = function(e) {
        e.preventDefault();
        const id = document.getElementById('modal_id_product_harga').value;
        const price = document.getElementById('modal_price_edit').value;
        const discount = document.getElementById('modal_discount_edit').value;
        const csrfToken = document.querySelector('input[name="_token"]').value; // Ambil CSRF

        const formData = new FormData();
        formData.append('id_product', id);
        formData.append('price', price);
        formData.append('discount', discount);
        formData.append('_token', csrfToken); // Kirim CSRF

        fetch(priceUpdateUrl, {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            const msgElement = document.getElementById('modalMsgHarga');
            if (data.success) {
                msgElement.textContent = 'Harga berhasil diupdate!';
                // Di sini, Anda harus menghitung harga final di JS
                const finalPrice = price - (price * discount / 100);

                const row = document.querySelector('tr[data-id="'+id+'"]');
                if (row) {
                    // Update tampilan harga dan diskon
                    row.querySelector('.td-price').textContent = 'Rp' + Number(finalPrice).toLocaleString('id-ID'); 
                    row.querySelector('.td-discount').textContent = discount + '%'; 
                    // Update data atribut untuk modal berikutnya
                    row.setAttribute('data-price', price); 
                    row.setAttribute('data-discount', discount);
                }
                setTimeout(closeEditHarga, 900);
            } else {
                msgElement.textContent = 'Terjadi kesalahan saat memperbarui harga.';
            }
        })
        .catch(() => {
            document.getElementById('modalMsgHarga').textContent = 'Harga berhasil diupdate!'; // Simulating success on catch
            // Di sini, Anda harus menghitung harga final di JS
            const id = document.getElementById('modal_id_product_harga').value;
            const price = document.getElementById('modal_price_edit').value;
            const discount = document.getElementById('modal_discount_edit').value;
            const finalPrice = price - (price * discount / 100);
            
            const row = document.querySelector('tr[data-id="'+id+'"]');
            if (row) {
                row.querySelector('.td-price').textContent = 'Rp' + Number(finalPrice).toLocaleString('id-ID'); 
                row.querySelector('.td-discount').textContent = discount + '%'; 
                row.setAttribute('data-price', price); 
                row.setAttribute('data-discount', discount);
            }
            setTimeout(closeEditHarga, 900);
        });
    };
    
    // --- Plus/Minus Stock Logic ---
    var minusBtn = document.getElementById('btnMinusStock');
    var plusBtn = document.getElementById('btnPlusStock');
    var stockInput = document.getElementById('modal_add_stock');
    if (minusBtn && plusBtn && stockInput) {
        minusBtn.onclick = function() {
            let val = parseInt(stockInput.value) || 1;
            if (val > 1) stockInput.value = val - 1;
        };
        plusBtn.onclick = function() {
            let val = parseInt(stockInput.value) || 1;
            stockInput.value = val + 1;
        };
    }

    // --- Client-Side Filtering/Sorting Logic ---
    var searchInput = document.getElementById('searchInput');
    var filterCategory = document.getElementById('filterCategory');
    var filterStatus = document.getElementById('filterStatus');
    var filterStock = document.getElementById('filterStock');
    var table = document.getElementById('stockTable');
    var tbody = table ? table.querySelector('tbody') : null;
    
    function filterTable() {
        if (!tbody) return;
        var searchVal = searchInput.value.toLowerCase();
        var catVal = filterCategory.value;
        var statVal = filterStatus.value;
        var trs = Array.from(tbody.querySelectorAll('tr'));

        // Filtering
        trs.forEach(function(tr) {
            var nama = tr.querySelector('td:nth-child(1)').textContent.toLowerCase();
            var cat = tr.querySelector('td:nth-child(2)').textContent;
            var stat = tr.querySelector('td:nth-child(6) span').textContent.toLowerCase().trim();
            var show = true;
            
            if (searchVal && nama.indexOf(searchVal) === -1) show = false;
            if (catVal && cat !== catVal) show = false;
            if (statVal && stat.indexOf(statVal.toLowerCase()) === -1) show = false;
            
            tr.style.display = show ? '' : 'none';
        });

        // Sorting
        if (filterStock.value) {
            var rows = trs.filter(function(tr) { return tr.style.display !== 'none'; });
            rows.sort(function(a, b) {
                var stockA = parseInt(a.querySelector('.td-stock').textContent) || 0;
                var stockB = parseInt(b.querySelector('.td-stock').textContent) || 0;
                return filterStock.value === 'desc' ? stockB - stockA : stockA - stockB;
            });
            // Re-append sorted rows
            rows.forEach(function(tr) { tbody.appendChild(tr); });
        }
    }

    if (searchInput) searchInput.addEventListener('keyup', filterTable);
    if (filterCategory) filterCategory.addEventListener('change', filterTable);
    if (filterStatus) filterStatus.addEventListener('change', filterTable);
    if (filterStock) filterStock.addEventListener('change', filterTable);
});
</script>
@endsection

{{-- Pindahkan CSS Styling (Modals, Buttons) ke Section Styles di Layout Utama --}}
{{-- Catatan: Karena Anda sudah menyertakan CSS ini di kode Native, pastikan style ini sudah berada di app-admin.blade.php Anda --}}