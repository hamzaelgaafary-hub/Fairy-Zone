<nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">

        <a href="{{ route('home') }}" class="text-xl font-semibold text-gray-800">
            Fairy Zone
        </a>

        <div class="hidden md:flex gap-6 text-sm text-gray-600">
            <a href="{{ route('products.index') }}">All Products</a>
            @foreach($categories as $cat)
                <a href="{{ route('products.index', ['category' => $cat->id]) }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('cart.index') }}" class="relative">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6h11" />
                </svg>
                @if(session('cart'))
                    <span
                        class="absolute -top-2 -right-2 bg-gray-800 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </a>
            
            @auth
                @if (Auth::user()->role == 'user')<!-- User role  still not ended-->
                    <a href="{{ route('filament.user.pages.dashboard') }}" class="text-sm text-gray-600">
                        {{ auth()->user()->name }} Dashboard
                    </a>

                @elseif (Auth::user()->role == 'admin') <!-- Admin role -->
                    <a href="{{ route('filament.admin.pages.dashboard') }}"
                        class="text-sm bg-gray-800 text-white px-4 py-1.5 rounded-lg">
                        {{ auth()->user()->name }} Dashboard
                    </a>

                @endif


                <form action="{{ route('filament.user.auth.logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('layouts.logout') }}
                    </a>
                </form>

            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-600 ">
                    Login
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-sm bg-gray-800 text-white px-4 py-1.5 rounded-lg">
                        Register
                    </a>
                @endif
            @endauth
        </div>

    </div>
</nav>