@extends('layout.app')

@section('title', 'Edit Profile - Nail Studio')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2>Edit Profile</h2>
    </div>
    
    <div class="col-md-8 offset-md-2">
        <div class="profile-section">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="text-center mb-4">
                    <img src="{{ $userPhotoUrl }}" class="user-avatar mb-3" alt="Profile Photo">
                    <div>
                        <input type="file" name="photo" id="photo" class="form-control">
                        <small class="form-text text-muted">Upload a square image for best results</small>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="fullname" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $user['fullname'] }}">
                </div>
                
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user['username'] }}">
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user['email'] }}">
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection