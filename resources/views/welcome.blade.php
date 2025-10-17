@extends('layout.app')

@section('title', 'Welcome to Nail Studio')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome to Nail Studio</div>

                <div class="card-body">
                    <h2 class="text-center mb-4">Premium Nail Care Products</h2>
                    
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/banner.jpg') }}" alt="Nail Studio Banner" class="img-fluid rounded">
                    </div>
                    
                    <p class="lead text-center">Discover our exclusive collection of professional nail care products.</p>
                    
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Browse Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border: none;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin-top: 2rem;
    }
    
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #eee;
        font-weight: bold;
        font-size: 1.2rem;
    }
</style>
@endpush