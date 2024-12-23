<!-- Sidebar Overlay -->
<div x-show="sidebarOpen" 
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
     @click="sidebarOpen = false"
     x-cloak></div>

<!-- Sidebar -->
<aside class="fixed inset-y-0 z-30 flex flex-col flex-shrink-0 w-64 max-h-screen overflow-hidden transition-all transform bg-white border-r border-gray-200 shadow-sm lg:z-auto lg:static lg:translate-x-0"
       :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
    
    <!-- Logo and Brand -->
    <div class="flex items-center justify-between flex-shrink-0 p-4 bg-[#4d5bf9]">
        <div class="flex items-center">
            <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                <span class="text-[#4d5bf9] font-bold text-xl">L</span>
            </div>
            <span class="text-lg font-semibold text-white ml-3">Custom App</span>
        </div>
        <!-- Close button - show only on mobile -->
        <button @click="sidebarOpen = false" class="p-1 text-white hover:text-gray-200 lg:hidden">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <nav class="flex-1 overflow-hidden hover:overflow-y-auto">
        <ul class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors text-[#4d5bf9] hover:bg-[#4d5bf9]/20 hover:text-white {{ request()->routeIs('dashboard') ? 'bg-[#4d5bf9] text-white' : '' }}">
                <i class="fas fa-home w-5 text-center"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('users.index') }}"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors text-[#4d5bf9] hover:bg-[#4d5bf9]/20 hover:text-white {{ request()->routeIs('users.index') ? 'bg-[#4d5bf9] text-white' : '' }}">
                <i class="fas fa-users w-5 text-center"></i>
                <span>Users</span>
            </a>

            <a href="#"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors text-[#4d5bf9] hover:bg-[#4d5bf9]/20 hover:text-white">
                <i class="fas fa-trophy w-5 text-center"></i>
                <span>Leaderboard</span>
            </a>

            <a href="#"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors text-[#4d5bf9] hover:bg-[#4d5bf9]/20 hover:text-white">
                <i class="fas fa-shopping-cart w-5 text-center"></i>
                <span>Orders</span>
            </a>

            <a href="{{ route('products.index') }}"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors text-[#4d5bf9] hover:bg-[#4d5bf9]/20 hover:text-white {{ request()->routeIs('products.index') ? 'bg-[#4d5bf9] text-white' : '' }}">
                <i class="fas fa-box w-5 text-center"></i>
                <span>Products</span>
            </a>

            <a href="#"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors text-[#4d5bf9] hover:bg-[#4d5bf9]/20 hover:text-white">
                <i class="fas fa-chart-line w-5 text-center"></i>
                <span>Sales Report</span>
            </a>

            <a href="#"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors text-[#4d5bf9] hover:bg-[#4d5bf9]/20 hover:text-white">
                <i class="fas fa-envelope w-5 text-center"></i>
                <span>Messages</span>
            </a>

            <!-- Settings Dropdown -->
            <div class="relative mt-4 pt-4 border-t border-gray-200" x-data="{ open: false }">
                <button @click="open = !open" 
                    class="flex items-center w-full space-x-3 px-4 py-3 rounded-lg transition-colors text-[#4d5bf9] hover:bg-[#4d5bf9]/20 hover:text-white">
                    <i class="fas fa-cog w-5 text-center"></i>
                    <span>Settings</span>
                </button>

                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute left-0 mt-2 w-48 rounded-lg shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5"
                     @click.away="open = false">
                    
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center px-4 py-2 text-sm text-[#4d5bf9] hover:bg-[#4d5bf9]/20 hover:text-white">
                        <i class="fas fa-user w-5 text-center mr-2"></i>
                        {{ __('Profile') }}
                    </a>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt w-5 text-center mr-2"></i>
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </ul>
    </nav>
</aside>
