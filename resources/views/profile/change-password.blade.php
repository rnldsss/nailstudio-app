@extends('layout.app')

@section('title', 'Change Password - Nail Studio')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2>Change Password</h2>
    </div>
    
    <div class="col-md-6 offset-md-3">
        <div class="profile-section">
            <form action="{{ route('profile.update-password') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                </div>
                
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                </div>
                
                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Update Password</button>
                    <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection