<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>@yield('title', 'Shop')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="#F2EFE7 font-sans text-black">
    
    {{-- Chat Bubble Button --}}
    <button aria-label="Chat" class="fixed bottom-6 right-6 bg-white rounded-full w-12 h-12 flex items-center justify-center shadow-lg z-50">
 	    <i class="fas fa-comment-alt text-black text-lg"></i>
 	</button>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        @yield('content')
    </main>
</body>
</html>