@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/filecssnya.css') }}">
<div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6 text-pink-700">Checkout</h1>

    <!-- Order Details -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4">Order Details</h2>
        @if(empty($cartItems))
            <p class="text-center py-8 text-gray-500">Your cart is empty.</p>
        @else
            <ul class="divide-y divide-gray-200 mb-4">
                @foreach($cartItems as $item)
                    @php
                        $priceFormatted = number_format($item['price'], 0, ',', '.');
                        $priceAfterDiscount = $item['price'] * (1 - $item['discount'] / 100);
                        $priceAfterDiscountFormatted = number_format($priceAfterDiscount, 0, ',', '.');
                    @endphp
                    <li class="py-2 flex justify-between items-center">
                        <span>{{ $item['namaproduct'] }} <span class="text-xs text-gray-500">x{{ $item['qty'] }}</span></span>
                        <span class="font-medium text-gray-800">
                            @if($item['discount'] > 0)
                                <span class="line-through text-gray-500">Rp{{ $priceFormatted }}</span>
                                <span class="font-semibold text-gray-800">Rp{{ $priceAfterDiscountFormatted }}</span>
                            @else
                                Rp{{ $priceFormatted }}
                            @endif
                        </span>
                    </li>
                @endforeach
            </ul>
            <div class="flex justify-between items-center border-t pt-4">
                <span class="font-semibold text-gray-900">Total</span>
                <span class="font-semibold text-pink-700 text-lg">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
        @endif
    </div>

    <!-- Payment Method -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4">Select Payment Method</h2>
        <label class="flex items-center gap-3 cursor-pointer">
            <input type="radio" name="payment_method" value="qris" checked class="accent-pink-500">
            <span class="text-gray-700 font-medium">QRIS (E-wallet & Bank)</span>
        </label>
        <p class="text-xs text-gray-500 mt-2">Other payment methods coming soon.</p>
    </div>

    <!-- Shipping Address -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Shipping Address</h2>
            <!-- In a real app, this would trigger a modal to add a new address -->
            <button class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-1 rounded text-sm font-semibold">Add New Address</button>
        </div>
        @if(!empty($addresses))
            @foreach($addresses as $i => $addr)
                <label class="flex items-center gap-2 cursor-pointer mb-2">
                    <input type="radio" name="selected_address" value="{{ $addr['id'] }}" @if($i === 0) checked @endif class="accent-pink-500">
                    <span class="text-gray-700">{{ $addr['address'] }}</span>
                </label>
            @endforeach
        @else
            <p class="text-gray-500">You don't have a saved address yet.</p>
        @endif
    </div>

    <!-- Proceed Button -->
    <div class="flex justify-end">
        <button class="px-6 py-2 rounded bg-pink-600 text-white font-semibold hover:bg-pink-700 transition">Proceed to Payment</button>
    </div>
</div>
@endsection