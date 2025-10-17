<section id="sidebar">
    <a href="{{ url('/') }}" class="brand">
        <img src="{{ asset('images/logonails.png')}}" width=75 height=75></img>
    </a>
    <ul class="side-menu top">
        {{-- Dashboard / Order/Transaction --}}
        <li class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
            <a href="{{ route('dashboard.index') }}">
                <i class='bx bxs-dashboard' ></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        {{-- Link ke Produk (Contoh) --}}
        <li>
            <a href="{{ url('/products') }}">
                <i class='bx bxs-shopping-bag-alt' ></i>
                <span class="text">My Product</span>
            </a>
        </li>
        {{-- Link ke Analitik/Laporan (Contoh) --}}
        <li>
            <a href="{{ url('/analytics') }}">
                <i class='bx bxs-doughnut-chart' ></i>
                <span class="text">Analytics</span>
            </a>
        </li>
        {{-- Link ke Pesan/Review (Contoh) --}}
        <li>
            <a href="{{ url('/message') }}">
                <i class='bx bxs-message-dots' ></i>
                <span class="text">Message</span>
            </a>
        </li>
        {{-- Link ke Tim/User (Contoh) --}}
        <li>
            <a href="{{ url('/team') }}">
                <i class='bx bxs-group' ></i>
                <span class="text">Team</span>
            </a>
        </li>
    </ul>

    <ul class="side-menu">
        {{-- Link ke Pengaturan (Contoh) --}}
        <li>
            <a href="{{ url('/settings') }}">
                <i class='bx bxs-cog' ></i>
                <span class="text">Settings</span>
            </a>
        </li>
        {{-- Link Logout (Contoh) --}}
        <li>
            <a href="{{ url('/logout') }}" class="logout">
                <i class='bx bxs-log-out-circle' ></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>