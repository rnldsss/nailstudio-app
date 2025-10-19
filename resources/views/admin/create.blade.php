@extends('layouts.app-admin')

@section('content')
<div class="head-title">
    <div class="left">
        <h1>Add Product</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li><a href="{{ route('product.index') }}">Product</a></li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li><a class="active" href="#">Add</a></li>
        </ul>
    </div>
</div>

<div class="product-form-container">
    <h2>Tambah Produk Baru</h2>
    
    {{-- Form mengarah ke route product.store (POST) --}}
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="form-style">
        @csrf
        
        {{-- Menampilkan pesan error validasi umum --}}
        @if ($errors->any())
            <div class="alert-danger" style="padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                <strong>Terjadi Kesalahan Validasi:</strong>
                <ul style="margin: 5px 0 0 15px; list-style-type: disc;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="form-group">
            <label for="namaproduct">Nama Produk</label>
            <input type="text" name="namaproduct" id="namaproduct" value="{{ old('namaproduct') }}" required>
            @error('namaproduct') <div class="text-error">{{ $message }}</div> @enderror 
        </div>
        
        <div class="form-group">
            <label for="category">Kategori</label>
            <input type="text" name="category" id="category" value="{{ old('category') }}" required>
            @error('category') <div class="text-error">{{ $message }}</div> @enderror
        </div>
        
        <div class="form-group">
            <label for="stock">Stock Awal</label>
            <input type="number" name="stock" id="stock" min="0" value="{{ old('stock', 0) }}" required>
            @error('stock') <div class="text-error">{{ $message }}</div> @enderror
        </div>
        
        <div class="form-group">
            <label for="price">Harga (Rp)</label>
            <input type="number" name="price" id="price" min="0" value="{{ old('price') }}" required>
            @error('price') <div class="text-error">{{ $message }}</div> @enderror
        </div>
        
        <div class="form-group">
            <label for="discount">Diskon (%)</label>
            <input type="number" name="discount" id="discount" min="0" max="100" value="{{ old('discount', 0) }}">
            @error('discount') <div class="text-error">{{ $message }}</div> @enderror
        </div>
        
        <div class="form-group">
            <label for="image">Gambar Produk</label>
            <input type="file" name="image" id="image">
            @error('image') <div class="text-error">{{ $message }}</div> @enderror
        </div>
        
        <button type="submit" class="btn-submit">Simpan Produk</button>
    </form>
</div>
@endsection

@section('styles')
<style>
/* CSS khusus untuk form */
.product-form-container { 
    max-width: 600px; 
    margin: 30px auto; 
    padding: 25px; 
    background: #fff; 
    border-radius: 10px; 
    box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
}
/* ... CSS lainnya tetap sama ... */
.form-group { 
    margin-bottom: 15px; 
}
.form-group label { 
    display: block; 
    margin-bottom: 5px; 
    font-weight: 600; 
    color: #555; 
}
.form-group input[type="text"], 
.form-group input[type="number"], 
.form-group input[type="file"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
}
.btn-submit {
    background-color: #8B1D3B;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s;
}
.btn-submit:hover {
    background-color: #6a162d;
}

/* Style untuk pesan error Laravel */
.text-error {
    color: #dc3545; /* Merah */
    font-size: 0.85em;
    margin-top: 5px;
}
.alert-danger {
    background-color: #f8d7da; /* Latar belakang merah muda */
    border: 1px solid #f5c6cb;
    color: #721c24;
}
</style>
@endsection