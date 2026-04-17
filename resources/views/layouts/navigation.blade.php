<nav x-data="{ open: false }" class="bg-transparent backdrop-blur-md border-b border-white/5">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center w-full">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="p-2 bg-indigo-600/20 rounded-xl border border-indigo-500/30">
                         <svg class="h-8 w-8 text-indigo-500 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279L12 18.897l-7.416 4.516 1.48-8.279-6.064-5.828 8.332-1.151z"/>
                        </svg>
                    </a>
                </div>

                <!-- Navigation Links (Centered) -->
                <div class="hidden sm:flex flex-1 justify-center space-x-12 uppercase tracking-[0.2em] text-sm font-semibold">
                    <a href="{{ route('dashboard') }}" 
                       class="{{ request()->routeIs('dashboard') ? 'text-indigo-400 border-b-2 border-indigo-500 pb-1' : 'text-gray-400 hover:text-gray-200 transition' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('product.index') }}" 
                       class="{{ request()->routeIs('product.index*') ? 'text-indigo-400 border-b-2 border-indigo-500 pb-1' : 'text-gray-400 hover:text-gray-200 transition' }}">
                        Product
                    </a>
                    <a href="/about" 
                       class="{{ request()->path() === 'about' ? 'text-indigo-400 border-b-2 border-indigo-500 pb-1' : 'text-gray-400 hover:text-gray-200 transition' }}">
                        About
                    </a>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition group">
                                <span class="text-sm font-medium text-gray-300 group-hover:text-white transition">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-500 transition group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-[#1e293b] border border-white/10 rounded-xl overflow-hidden shadow-2xl">
                                <x-dropdown-link :href="route('profile.edit')" class="hover:bg-indigo-500/10 text-gray-300">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                            class="hover:bg-red-500/10 text-gray-300">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" :class="{'hidden': open, 'inline-flex': ! open }">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" :class="{'hidden': ! open, 'inline-flex': open }">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
