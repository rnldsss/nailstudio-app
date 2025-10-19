<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>{{ $title ?? 'Halaman Khusus' }}</title>

    {{-- Gunakan Tailwind dan font yang sama agar warna & gaya tetap konsisten --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>

    <style>
        body { font-family: "Inter", sans-serif; }
    </style>
</head>
<body class="bg-[#ffecf5] min-h-screen flex flex-col">
    {{-- Bagian konten halaman --}}
    <main class="flex-grow">
        @yield('content')
    </main>
</body>
</html>
