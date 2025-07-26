{{-- resources/views/layouts/partials/navigation.blade.php --}}
<header class="bg-white shadow-sm border-b border-gray-100">
    <nav class="px-4 sm:px-6 lg:px-8" x-data="{ open: false }">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
           <!-- Logo -->
<div class="flex-shrink-0">
    <a href="/" class="flex items-center">
        <img class="h-[120px] w-auto" src="{{ asset('images/logo.png') }}" alt="Ghana Insider Logo">
    </a>
</div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-600 font-medium transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 font-medium transition-colors">Sign Up</a>
                @else
        {{-- START: REPLACEMENT BLOCK --}}
        
        {{-- Optional: Show user's name --}}
        <span class="text-gray-700 font-medium">Hello, {{ Auth::user()->name }}</span>

        <!-- Logout Form -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();"
                    class="text-gray-700 hover:text-primary-600 font-medium transition-colors">
                Log Out
            </a>
        </form>
        {{-- END: REPLACEMENT BLOCK --}}
    @endguest
</div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center space-x-4">
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-600 font-medium transition-colors">Login</a>
                <button @click="open = !open" class="text-gray-700 hover:text-primary-600 focus:outline-none" aria-label="Toggle menu">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="open" x-transition class="md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 border-t border-gray-100 mt-2">
                <a href="{{ route('register') }}" class="block bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 font-medium text-center transition-colors">Sign Up</a>
            </div>
        </div>
    </nav>
</header>
