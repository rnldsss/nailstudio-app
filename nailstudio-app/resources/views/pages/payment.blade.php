@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How QRIS Payment Works</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Custom font styling for the page -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <!-- Header section showing dynamic title and intro -->
    <section class="text-center py-12 px-4 bg-pink-200 text-white">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl font-bold mb-4">{{ $title }}</h1>
            <p class="text-lg leading-relaxed">{{ $intro }}</p>
        </div>
    </section>

    <!-- Steps Section: iterates through the steps array -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold mb-10 text-center text-gray-900">Simple Steps to Pay with QRIS</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach ($steps as $step)
            <section class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center mb-4">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-pink-100 text-pink-600 font-bold text-lg mr-4">
                        {{ $step['number'] }}
                    </div>
                    <h3 class="text-xl font-semibold">{{ $step['title'] }}</h3>
                </div>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    {{ $step['content'] }}
                </p>

                @if ($step['number'] === 1)
                    <!-- Payment method options displayed only in step 1 -->
                    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                        <h4 class="font-semibold text-sm mb-2">Payment Method</h4>
                        <div class="space-y-2">
                            <label class="flex items-center justify-between border border-gray-300 rounded-md px-3 py-2 cursor-pointer hover:bg-gray-50">
                                <div class="flex items-center">
                                    <input type="radio" name="payment" class="mr-3">
                                    <span class="text-sm">Credit/Debit Card</span>
                                </div>
                                <div class="flex space-x-1">
                                    <div class="w-6 h-4 bg-blue-500 rounded text-xs text-white flex items-center justify-center">V</div>
                                    <div class="w-6 h-4 bg-red-500 rounded text-xs text-white flex items-center justify-center">M</div>
                                </div>
                            </label>

                            <label class="flex items-center justify-between border-2 border-pink-500 bg-pink-50 rounded-md px-3 py-2 cursor-pointer">
                                <div class="flex items-center">
                                    <input type="radio" name="payment" checked class="mr-3">
                                    <span class="text-sm font-medium">QRIS Payment</span>
                                </div>
                                <div class="bg-pink-600 text-white px-2 py-1 rounded text-xs font-bold">QRIS</div>
                            </label>

                            <label class="flex items-center justify-between border border-gray-300 rounded-md px-3 py-2 cursor-pointer hover:bg-gray-50">
                                <div class="flex items-center">
                                    <input type="radio" name="payment" class="mr-3">
                                    <span class="text-sm">Bank Transfer</span>
                                </div>
                            </label>
                        </div>
                    </div>
                @endif

                @if ($step['number'] === 2)
                    <!-- QRIS scanning placeholder in step 2 -->
                    <div class="border-2 border-dashed border-pink-300 rounded-lg p-8 text-center bg-pink-50">
                        <div class="w-48 h-48 mx-auto bg-white border-2 border-gray-200 rounded-lg flex items-center justify-center mb-4">
                            <div class="text-center">
                                <div class="w-32 h-32 bg-gray-100 border-2 border-gray-300 rounded-lg mx-auto mb-2 flex items-center justify-center">
                                    <span class="text-gray-500 text-xs">QRIS Code</span>
                                </div>
                                <p class="text-xs text-gray-500">Scan with your app</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 font-medium">QRIS code will appear here after selecting payment method</p>
                    </div>
                @endif

                @if ($step['number'] === 3)
                    <!-- Confirmation example UI in step 3 -->
                    <div class="border border-gray-200 rounded-lg p-4 bg-gradient-to-b from-pink-50 to-white">
                        <div class="max-w-xs mx-auto">
                            <div class="bg-pink-600 text-white text-center py-2 rounded-t-lg">
                                <span class="text-sm font-medium">Payment Confirmation</span>
                            </div>
                            <div class="bg-white border-x border-gray-200 p-4 space-y-3">
                                <div class="text-center">
                                    <p class="text-sm text-gray-600">Pay to</p>
                                    <p class="font-semibold">Merchant Name</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-pink-600">Rp 150,000</p>
                                </div>
                                <div class="bg-pink-600 text-white text-center py-2 rounded">
                                    <span class="text-sm font-medium">Confirm Payment</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($step['number'] === 4)
                    <!-- Success message in step 4 -->
                    <div class="border border-green-200 rounded-lg p-4 bg-green-50">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-green-800 mb-1">Payment Successful!</h4>
                            <p class="text-sm text-green-700">Transaction ID: #QR123456789</p>
                            <p class="text-xs text-green-600 mt-2">Receipt sent to your email</p>
                        </div>
                    </div>
                @endif
            </section>
            @endforeach
        </div>

        <!-- Compatible apps section -->
        <section class="mt-16 text-center">
            <h3 class="text-xl font-semibold mb-6">Compatible with All Major Indonesian E-Wallets</h3>
            <div class="flex flex-wrap justify-center gap-6">
                <div class="bg-white rounded-lg shadow-md p-4 w-24 h-24 flex items-center justify-center">
                    <span class="text-green-600 font-bold text-sm">GoPay</span>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4 w-24 h-24 flex items-center justify-center">
                    <span class="text-purple-600 font-bold text-sm">OVO</span>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4 w-24 h-24 flex items-center justify-center">
                    <span class="text-blue-600 font-bold text-sm">DANA</span>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4 w-24 h-24 flex items-center justify-center">
                    <span class="text-orange-600 font-bold text-sm">ShopeePay</span>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4 w-24 h-24 flex items-center justify-center">
                    <span class="text-red-600 font-bold text-sm">LinkAja</span>
                </div>
            </div>
            <p class="text-gray-600 mt-4 text-sm">And all Indonesian banking apps that support QRIS</p>
        </section>
    </main>
</body>
</html>
@endsection