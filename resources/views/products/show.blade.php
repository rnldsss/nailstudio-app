@extends('layout.app')

@section('title', 'Product Details - Nail Studio')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product Details</li>
            </ol>
        </nav>
    </div>
    
    <div class="col-md-5">
        <img src="{{ asset('images/products/sample-product.jpg') }}" class="img-fluid rounded" alt="Product Image">
    </div>
    
    <div class="col-md-7">
        <h2>Sample Product (ID: {{ $id }})</h2>
        <p class="lead">Rp 90,000</p>
        
        <div class="mb-4">
            <h5>Description</h5>
            <p>This is a sample product description. In a real application, this would come from your database.</p>
        </div>
        
        <form action="#" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" style="width: 100px;">
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Add to Cart</button>
                <a href="{{ route('profile.favorites.add', $id) }}" class="btn btn-outline-danger">Add to Favorites</a>
            </div>
        </form>
    </div>
</div>
@endsection