<aside id="sidebar" class="fixed z-20 h-full top-0 left-0 pt-16 flex lg:flex flex-shrink-0 flex-col w-64 transition-width duration-75 lg:w-64 bg-white/70 backdrop-blur-xl border-r border-pink-100 hidden shadow-[4px_0_24px_rgba(252,211,228,0.2)]" aria-label="Sidebar">
    <div class="relative flex-1 flex flex-col min-h-0 pt-0">
        <div class="flex-1 px-3 py-4 divide-y divide-pink-100 flex flex-col space-y-2 overflow-y-auto">
            <ul class="space-y-2 pb-2">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-pink-100 text-pink-900 shadow-sm shadow-pink-200/50' : 'text-gray-700 hover:bg-pink-50 hover:text-pink-800' }} text-base font-medium rounded-xl flex items-center p-3 group w-full transition-all">
                        <svg class="w-6 h-6 {{ request()->routeIs('dashboard') ? 'text-pink-600' : 'text-pink-400 group-hover:text-pink-600' }} transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('clients.index') }}" class="{{ request()->routeIs('clients.index') ? 'bg-pink-100 text-pink-900 shadow-sm shadow-pink-200/50' : 'text-gray-700 hover:bg-pink-50 hover:text-pink-800' }} text-base font-medium rounded-xl flex items-center p-3 group w-full transition-all">
                        <svg class="w-6 h-6 {{ request()->routeIs('clients.index') ? 'text-pink-600' : 'text-pink-400 group-hover:text-pink-600' }} flex-shrink-0 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        <span class="ml-3 flex-1 whitespace-nowrap">Clients</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="text-gray-700 hover:bg-pink-50 hover:text-pink-800 text-base font-medium rounded-xl flex items-center p-3 group w-full transition-all">
                        <svg class="w-6 h-6 text-pink-400 flex-shrink-0 group-hover:text-pink-600 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path></svg>
                        <span class="ml-3 flex-1 whitespace-nowrap">Payments</span>
                    </a>
                </li>
            </ul>
            <ul class="space-y-2 pt-4 border-t border-pink-100 mt-4">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left font-medium text-gray-700 rounded-xl hover:bg-pink-50 hover:text-red-600 flex items-center p-3 group transition-all">
                            <svg class="flex-shrink-0 w-6 h-6 text-pink-400 group-hover:text-red-500 transition duration-75" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span class="ml-3 flex-1 whitespace-nowrap">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
            <div class="space-y-2 pt-2 border-t border-pink-100 mt-auto">
                <a href="#" class="text-gray-700 text-base font-medium rounded-xl hover:bg-pink-50 hover:text-pink-800 flex items-center p-3 group w-full transition-all">
                    <svg class="w-6 h-6 text-pink-400 group-hover:text-pink-600 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                    <span class="ml-3">Help</span>
                </a>
            </div>
        </div>
    </div>
</aside>

<!-- Backdrop to overlay screen when sidebar is open on mobile -->
<div class="bg-gray-900 opacity-50 hidden fixed inset-0 z-10" id="sidebarBackdrop"></div>

<script>
    // Simple script to toggle sidebar on mobile view
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggleSidebarMobile');
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');

        if(toggleBtn && sidebar && backdrop) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
                backdrop.classList.toggle('hidden');
            });

            backdrop.addEventListener('click', () => {
                sidebar.classList.add('hidden');
                backdrop.classList.add('hidden');
            });
        }
    });
</script>
