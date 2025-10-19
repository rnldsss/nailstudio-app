@php
    // Definisikan semua link agar dinamis di Laravel (SIMULASI DATA)
    $footer_links = [
        'customer_service' => [
            ['text' => 'Discount', 'url' => route('discount.index')],
            ['text' => 'Frequently Asked Questions', 'url' => url('pages/service.php')], 
            ['text' => 'My Account', 'url' => url('pages/profile.php')],
            ['text' => 'Payment Options', 'url' => url('pages/payment.php')],
        ],
        'services' => [
            ['text' => 'Nail polish', 'url' => url('pages/nailPolish.php')],
            ['text' => 'Nail tools', 'url' => url('pages/nailTools.php')],
            ['text' => 'Nail care', 'url' => url('pages/nailCare.php')],
            ['text' => 'Nail art kits', 'url' => url('pages/nailKit.php')],
        ],
        'about_us' => [
            ['text' => 'Our Story', 'url' => url('pages/orders.php')],
            ['text' => 'Contact Us', 'url' => url('pages/service.php')],
            ['text' => 'Reviews', 'url' => url('pages/addreview.php')],
        ],
    ];
@endphp

<div id="footer-wrapper" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-20">
    
    {{-- Notifikasi Sukses/Error (Menggunakan Laravel Session) --}}
    @if(session('message'))
        @php
            // Menentukan kelas dan teks pesan berdasarkan session('message')
            $alertClass = ['success' => 'bg-green-100 border-green-400 text-green-700', 'error' => 'bg-red-100 border-red-400 text-red-700', 'invalid_email' => 'bg-yellow-100 border-yellow-400 text-yellow-700'];
            $alertText = ['success' => 'Berlangganan Newsletter berhasil! Terima kasih.', 'error' => 'Terjadi kesalahan saat berlangganan. Silakan coba lagi.', 'invalid_email' => 'Email tidak valid.'];
        @endphp
        <div class="{{ $alertClass[session('message')] ?? 'bg-gray-100 border-gray-400 text-gray-700' }} border px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ $alertText[session('message')] ?? 'Pesan tidak dikenal.' }}</span>
        </div>
    @endif

    {{-- Newsletter Section --}}
    <div class="bg-white rounded-lg p-6 sm:p-8 mb-14 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 sm:gap-0">
        <div>
            <h2 class="font-semibold text-lg leading-6 text-[#1a1a1a]">
                Join our newsletter
            </h2>
            <p class="text-sm text-[#4b4b4b] mt-1 max-w-md">
                Be the first to know about our latest updates, exclusive offers, and more.
            </p>
        </div>
        
        {{-- Form dikoreksi menggunakan route() Laravel dan CSRF --}}
        <form action="{{ route('footer.subscribe') }}" method="POST" class="flex w-full sm:w-auto gap-3">
            @csrf {{-- Wajib ada untuk Laravel Form Security --}}
            <input class="flex-grow sm:flex-grow-0 sm:w-[220px] rounded-md border border-gray-300 px-4 py-2 text-sm text-[#1a1a1a] placeholder:text-[#4b4b4b] focus:outline-none focus:ring-2 focus:ring-black" placeholder="Enter your email" required="" type="email" name="email" value="{{ old('email') }}"/>
            <button class="bg-black text-white rounded-md px-5 py-2 text-sm font-semibold hover:bg-gray-900 transition" type="submit">
                Subscribe
            </button>
        </form>
    </div>

    {{-- Footer Main --}}
    <footer class="text-[#1a1a1a]">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-y-10 gap-x-8 text-sm">
            {{-- Logo and Social --}}
            <div>
                <h3 class="font-semibold text-base mb-4">Nail Art Studio</h3>
                <div class="flex space-x-4">
                    <a aria-label="Facebook" class="text-[#1a1a1a] hover:text-gray-700" href="#"><i class="fab fa-facebook-f text-lg"></i></a>
                    <a aria-label="Instagram" class="text-[#1a1a1a] hover:text-gray-700" href="#"><i class="fab fa-instagram text-lg"></i></a>
                </div>
            </div>
            
            {{-- Customer Service (Loop Blade) --}}
            <div>
                <h4 class="font-semibold mb-3">Customer Service</h4>
                <ul class="space-y-2 text-[#4b4b4b]">
                    @foreach($footer_links['customer_service'] as $link)
                        <li><a class="hover:underline" href="{{ $link['url'] }}">{{ $link['text'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            
            {{-- Services (Loop Blade) --}}
            <div>
                <h4 class="font-semibold mb-3">Services</h4>
                <ul class="space-y-2 text-[#4b4b4b]">
                    @foreach($footer_links['services'] as $link)
                        <li><a class="hover:underline" href="{{ $link['url'] }}">{{ $link['text'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            
            {{-- About Us (Loop Blade) --}}
            <div>
                <h4 class="font-semibold mb-3">About Us</h4>
                <ul class="space-y-2 text-[#4b4b4b]">
                    @foreach($footer_links['about_us'] as $link)
                        <li><a class="hover:underline" href="{{ $link['url'] }}">{{ $link['text'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            
            {{-- Company Info --}}
            <div>
                <h4 class="font-semibold mb-3">Company info</h4>
                <div class="text-[#4b4b4b] space-y-3 text-xs max-w-[180px]">
                    <div>
                        <p class="font-semibold text-[10px] mb-0.5">Address</p>
                        <p>Jakarta, Indonesia</p>
                    </div>
                    <div>
                        <p class="font-semibold text-[10px] mb-0.5">Email</p>
                        <p>support@nailartstudio.com</p>
                    </div>
                    <div>
                        <p class="font-semibold text-[10px] mb-0.5">Business Number</p>
                        <p>123 456 789</p>
                    </div>
                    <div>
                        <p class="font-semibold text-[10px] mb-0.5">Company Reviews</p>
                        <div class="flex items-center space-x-2">
                           <img alt="Google star rating with 5 stars" class="h-5 w-auto" height="20" src="https://storage.googleapis.com/a1aa/image/849c18c5-0d0a-4934-53d5-277d521e11a7.jpg" width="60"/>
                           <img alt="Product Review logo" class="h-5 w-auto" height="20" src="https://storage.googleapis.com/a1aa/image/62aa740b-6dec-41ab-076f-1f3a86b77ca1.jpg" width="80"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Bottom Bar --}}
        <div class="mt-14 text-center text-[10px] text-[#4b4b4b]">
            <div class="flex flex-col items-center space-y-4">
                <div class="flex flex-wrap gap-4 justify-center">
                    <span>© 2025 Nail Art Studio</span>
                    <a class="hover:underline" href="#">Privacy Policy</a>
                    <a class="hover:underline" href="#">Terms of Service</a>
                    <a class="hover:underline" href="#">Security Policy</a>
                </div>
            </div>
        </div>
    </footer>
</div>
