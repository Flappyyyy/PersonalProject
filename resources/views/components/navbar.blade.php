<nav class="bg-white/80 backdrop-blur-md border-b border-pink-100 fixed z-30 w-full h-16 shadow-sm shadow-pink-100/50">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar" class="lg:hidden mr-2 text-pink-600 hover:text-pink-900 cursor-pointer p-2 hover:bg-pink-50 focus:bg-pink-50 focus:ring-2 focus:ring-pink-100 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                </button>
                <a href="/" class="text-xl font-bold flex items-center lg:ml-2.5">
                    <span class="self-center whitespace-nowrap bg-clip-text text-transparent bg-gradient-to-r from-pink-500 to-pink-600 drop-shadow-sm">Paluwagan Tracking</span>
                </a>
            </div>
            <div class="flex items-center">
                <!-- User Profile / Logout -->
                <div class="flex items-center space-x-3">
                    <div class="text-sm font-semibold text-gray-700 hidden md:block">{{ auth()->user()->name }}</div>
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-pink-400 to-pink-500 text-white flex items-center justify-center font-bold uppercase text-xs shadow-md shadow-pink-200">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="text-sm text-gray-500 hover:text-red-600 font-medium transition-colors px-2 py-1 rounded hover:bg-red-50">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
