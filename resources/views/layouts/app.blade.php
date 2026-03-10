<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50 text-gray-900">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Paluwagan Management System') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Scripts / Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased h-[100dvh] overflow-hidden flex flex-col relative text-gray-800" style="font-family: 'Outfit', sans-serif;">
    <!-- Luxurious Silky Pink Background -->
    <div class="fixed inset-0 z-[-1] overflow-hidden bg-[#fff0f5]">
        <div class="absolute top-[-20%] left-[-10%] w-[80%] h-[70%] bg-gradient-to-br from-[#ffb6c1]/40 via-[#ffe4e1]/30 to-transparent rounded-[100%] blur-[80px] transform -rotate-12"></div>
        <div class="absolute bottom-[-20%] right-[-10%] w-[90%] h-[80%] bg-gradient-to-tl from-[#ffb6c1]/50 via-[#ffc0cb]/20 to-transparent rounded-[100%] blur-[100px] transform rotate-12"></div>
        <div class="absolute top-[20%] left-[10%] w-[60%] h-[30%] bg-white/70 rounded-[100%] blur-[90px] transform rotate-45"></div>
        <div class="absolute bottom-[20%] left-[30%] w-[40%] h-[40%] bg-white/50 rounded-[100%] blur-[80px]"></div>
    </div>

    <!-- Top Navbar -->
    <x-navbar />

    <div class="flex flex-1 overflow-hidden h-full mt-16 z-10">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto bg-white/40 backdrop-blur-md lg:ml-64 p-4 lg:p-8 transition-all duration-300">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
