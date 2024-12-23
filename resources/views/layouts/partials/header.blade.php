<header class="flex-shrink-0 border-b border-gray-200 bg-white">
    <div class="flex items-center justify-between p-4">
        <!-- Sidebar toggle button -->
        <button @click="sidebarOpen = !sidebarOpen" class="p-1 mr-4 lg:hidden">
            <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <div class="flex items-center space-x-4">
            <h1 class="text-2xl font-semibold text-[#4d5bf9]">{{ $header ?? 'Dashboard' }}</h1>
        </div>

        <div class="flex items-center space-x-4">
            <div class="relative">
                <select class="appearance-none bg-transparent border border-gray-300 rounded-lg px-4 py-2 text-gray-700 text-sm focus:ring-2 focus:ring-[#4d5bf9]">
                    <option>Eng (US)</option>
                    <option>Eng (UK)</option>
                </select>
            </div>

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-gray-300 rounded-full overflow-hidden">
                            <div class="w-full h-full flex items-center justify-center bg-[#4d5bf9] text-white">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="text-left">
                            <span class="block text-sm font-semibold">{{ Auth::user()->name }}</span>
                            <span class="text-xs text-gray-500">{{ Auth::user()->email }}</span>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Account') }}
                    </div>

                    <x-dropdown-link href="{{ route('profile.edit') }}">
                        <i class="fas fa-user mr-2"></i>
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <div class="border-t border-gray-200"></div>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                    @click.prevent="$root.submit();"
                                    class="text-red-600 hover:text-red-900">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</header>
