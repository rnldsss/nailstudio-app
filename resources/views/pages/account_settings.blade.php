@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/filecssnya.css') }}">
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Account Settings</h1>

    <div class="bg-white rounded-xl p-6 shadow-sm space-y-6">
        <!-- Username -->
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Username</label>
            <input type="text" value="{{ $user['username'] }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" readonly>
        </div>
        <!-- Full Name -->
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Full Name</label>
            <input type="text" value="{{ $user['fullname'] }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" readonly>
        </div>
        <!-- Email -->
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Email</label>
            <input type="email" value="{{ $user['email'] }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" readonly>
        </div>
        <!-- Change Password -->
        <div>
            <h3 class="text-sm font-semibold text-gray-700 mb-2">Change Password</h3>
            <input type="password" placeholder="Current password" class="w-full mb-2 border border-gray-300 rounded-lg px-3 py-2 text-sm">
            <input type="password" placeholder="New password" class="w-full mb-2 border border-gray-300 rounded-lg px-3 py-2 text-sm">
            <input type="password" placeholder="Confirm new password" class="w-full mb-2 border border-gray-300 rounded-lg px-3 py-2 text-sm">
            <button class="w-full bg-gray-100 text-gray-700 py-2 rounded-lg text-sm">Update Password</button>
        </div>
    </div>
</div>
@endsection