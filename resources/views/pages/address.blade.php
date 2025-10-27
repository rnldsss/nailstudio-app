@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/filecssnya.css') }}">
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Manage Addresses</h1>

    <div class="bg-white rounded-xl p-6 shadow-sm mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Your Addresses</h2>
        @if(empty($addresses))
            <p class="text-sm text-gray-600">You don't have any saved addresses.</p>
        @else
            <ul class="space-y-3">
                @foreach($addresses as $addr)
                    <li class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-medium text-sm">{{ $addr['address'] }}</p>
                            <p class="text-xs text-gray-500 capitalize">{{ $addr['type'] }} address</p>
                        </div>
                        <div class="flex gap-2">
                            <button class="text-pink-600 text-xs hover:underline">Edit</button>
                            <button class="text-red-600 text-xs hover:underline">Delete</button>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Add New Address</h2>
        <textarea rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm mb-3" placeholder="Enter new address"></textarea>
        <button class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-lg text-sm">Add Address</button>
    </div>
</div>
@endsection