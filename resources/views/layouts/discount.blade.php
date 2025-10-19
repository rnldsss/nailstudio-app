<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>
        {{-- Mengambil judul dari view konten, jika tidak ada, menggunakan default ini --}}
        @yield('title', 'Discount Nail Art and Cosmetics')
    </title>
    {{-- Tailwind CSS CDN dan Font Awesome --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet"/>
    <style>
        body { font-family: "Poppins", sans-serif; }
        /* Nail art themed colors */
        .btn-pink { background-color: #D6336C; }
        .btn-pink:hover { background-color: #B52B5A; }
        .label-pink { color: #D6336C; }
        .border-pink { border-color: #D6336C; }
        .bg-pink-light { background-color: #FDE8F0; }

        /* Continuous horizontal scrolling */
        @keyframes scroll-left {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .scrolling-wrapper {
            display: flex;
            width: max-content;
            animation: scroll-left 20s linear infinite;
        }
    </style>
</head>
<body class="bg-pink-light text-[#1A1A1A]">

    {{-- Tempat konten unik dari resources/views/pages/home_discount.blade.php akan muncul di sini --}}
    @yield('content') 

</body>
</html>