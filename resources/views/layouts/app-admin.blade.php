<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    {{-- PASTIKAN HANYA SATU SET LINK CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    
    {{-- CSS INLINE UNTUK STATUS --}}
    <style>
        select.status-select {
            padding: 4px 10px; border-radius: 9999px; font-weight: 600; 
            border: none; outline: none; cursor: pointer;
        }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-processing { background: #dbeafe; color: #1d4ed8; }
        .status-shipped { background: #ede9fe; color: #6b21a8; }
        .status-completed { background: #d1fae5; color: #065f46; }
        .table-container { margin: 32px 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px 12px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #8B1D3B; color: #FFFFFF; } 
        tr:nth-child(even) { background: #faf8fb; }
        
        /* CSS Tambahan untuk Navbar Search (diletakkan di sini jika Anda tidak memisahkan style2.css) */
        nav { display: flex; align-items: center; gap: 24px; padding: 20px 0; }
        nav .bx.bx-menu { cursor: pointer; font-size: 28px; }
        nav form.search { max-width: 400px; width: 100%; margin-left: 20px; }
        nav form.search .form-input { display: flex; align-items: center; height: 36px; }
        nav form.search .form-input input { flex-grow: 1; padding: 0 16px; border-radius: 36px 0 0 36px; border: 1px solid #ddd; background: #f0f0f0; height: 100%; outline: none; }
        nav form.search .form-input .search-btn { width: 36px; height: 100%; display: flex; justify-content: center; align-items: center; background: #8B1D3B; color: #FFFFFF; font-size: 18px; border: none; outline: none; border-radius: 0 36px 36px 0; cursor: pointer; }
        nav .notification { margin-left: auto; position: relative; font-size: 24px; }
        nav .profile img { width: 36px; height: 36px; object-fit: cover; border-radius: 50%; }
    </style>
    @yield('styles')
</head>
<body>
    
    {{-- SIDEBAR --}}
    @include('components.sidebar') 

    <section id="content">
        {{-- TAMBAHAN: Komponen Navbar dengan Search Bar --}}
        @include('components.navbar') 
        
        <main>
            @yield('content') 
        </main>
    </section>

    {{-- JS SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script> 
    @yield('scripts')
</body>
</html>