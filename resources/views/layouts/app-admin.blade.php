<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    {{-- 1. BOOTSTRAP, BOXICONS, DAN CSS KUSTOM --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    
    {{-- 2. CSS INLINE ANDA --}}
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
        th { background: #8B1D3B; color: #FFFFFF; } /* Diperbaiki agar tulisan hitam Anda terlihat */
        tr:nth-child(even) { background: #faf8fb; }
    </style>

    {{-- YIELD untuk CSS Tambahan (opsional) --}}
    @yield('styles')
</head>
<body>
    {{-- 3. SIDEBAR/NAVBAR (Ganti dengan component atau include Anda) --}}
    @include('components.sidebar') 

    <section id="content">
        <main>
            {{-- INI ADALAH TEMPAT KONTEN DASHBOARD ANDA AKAN MUNCUL --}}
            @yield('content') 
        </main>
    </section>

    {{-- 4. JS SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>