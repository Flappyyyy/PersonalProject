<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — Paluwagan Tracking</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased min-h-screen relative flex items-center justify-center p-4" style="font-family: 'Outfit', sans-serif;">
    <!-- Luxurious Silky Pink Background -->
    <div class="fixed inset-0 z-[-1] overflow-hidden bg-[#fff0f5]">
        <div class="absolute top-[-20%] left-[-10%] w-[80%] h-[70%] bg-gradient-to-br from-[#ffb6c1]/40 via-[#ffe4e1]/30 to-transparent rounded-[100%] blur-[80px] transform -rotate-12"></div>
        <div class="absolute bottom-[-20%] right-[-10%] w-[90%] h-[80%] bg-gradient-to-tl from-[#ffb6c1]/50 via-[#ffc0cb]/20 to-transparent rounded-[100%] blur-[100px] transform rotate-12"></div>
        <div class="absolute top-[20%] left-[10%] w-[60%] h-[30%] bg-white/70 rounded-[100%] blur-[90px] transform rotate-45"></div>
        <div class="absolute bottom-[20%] left-[30%] w-[40%] h-[40%] bg-white/50 rounded-[100%] blur-[80px]"></div>
    </div>

    <div class="w-full max-w-md">
        <!-- Logo / Branding -->
        <div class="text-center mb-8 relative z-10">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-pink-400 to-pink-500 rounded-2xl shadow-pink-200/50 shadow-lg mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 drop-shadow-sm">Paluwagan Tracking</h1>
            <p class="text-sm text-pink-700/80 mt-1 font-medium">Sign in to manage your clients and payments</p>
        </div>

        <!-- Card -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl shadow-pink-200/40 border border-white/50 p-8 relative z-10">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Welcome back</h2>

            <!-- Errors -->
            @if ($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                        value="{{ old('email') }}"
                        class="block w-full rounded-xl border border-pink-100 bg-white/60 px-4 py-2.5 text-sm text-gray-900 placeholder-pink-300 focus:border-pink-400 focus:ring-4 focus:ring-pink-100 focus:outline-none transition-all shadow-sm"
                        placeholder="you@example.com">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="block w-full rounded-xl border border-pink-100 bg-white/60 px-4 py-2.5 text-sm text-gray-900 placeholder-pink-300 focus:border-pink-400 focus:ring-4 focus:ring-pink-100 focus:outline-none transition-all shadow-sm"
                        placeholder="••••••••">
                </div>

                <!-- Remember me -->
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 rounded border-pink-300 text-pink-500 focus:ring-pink-400 bg-white/60">
                    <label for="remember" class="ml-2 text-sm text-gray-600 font-medium">Remember me</label>
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 rounded-xl bg-gradient-to-r from-pink-400 to-pink-500 hover:from-pink-500 hover:to-pink-600 text-white text-sm font-bold shadow-md shadow-pink-200 focus:outline-none focus:ring-4 focus:ring-pink-200 transition-all transform hover:-translate-y-0.5">
                    Sign in
                </button>
            </form>
        </div>

        <!-- Register Link -->
        <p class="mt-6 text-center text-sm text-gray-600 font-medium relative z-10">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-bold text-pink-600 hover:text-pink-700 transition-colors">Create one</a>
        </p>
    </div>

</body>
</html>
