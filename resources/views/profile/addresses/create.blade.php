@extends('layout.app')

@section('title', 'Add Address - Nail Studio')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2>Add New Address</h2>
    </div>
    
    <div class="col-md-6 offset-md-3">
        <div class="profile-section">
            <form action="{{ route('profile.addresses.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" id="type" name="type">
                        <option value="shipping">Shipping</option>
                        <option value="billing">Billing</option>
                    </select>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Save Address</button>
                    <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection