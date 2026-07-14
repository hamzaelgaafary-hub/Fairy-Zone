<x-app-layout title="Products — Fairy Zone">

    <div class="max-w-7xl mx-auto px-4 py-10">

        {{-- Breadcrumb --}}
        <nav class="text-sm text-gray-400 mb-8 flex gap-2">
            <a href="{{ route('home') }}" class="hover:text-gray-600">{{ __('layouts.home') }}</a>
            <span>/</span>
            <span class="text-gray-600">{{ __('layouts.products') }}</span>
        </nav>

        <div class="flex flex-col md:flex-row gap-10">

            {{-- Filters Sidebar --}}
            <aside class="w-full md:w-64 shrink-0">
                <form action="{{ route('products.index') }}" method="GET" class="space-y-6">

                    {{-- Search --}}
                    <div>
                        <label for="search"
                            class="block text-sm font-medium text-gray-700 mb-1">{{ __('layouts.Search') }}</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Product name..."
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-gray-500 focus:border-gray-500 text-sm">
                    </div>

                    {{-- Category --}}
                    <div>
                        <label for="category"
                            class="block text-sm font-medium text-gray-700 mb-1">{{ __('layouts.category') }}</label>
                        <select name="category" id="category"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-gray-500 focus:border-gray-500 text-sm">
                            <option value="">{{ __('layouts.All_Categories') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Sort --}}
                    <div>
                        <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">
                            {{__('layouts.Sort_By') }}
                        </label>
                        <select name="sort" id="sort"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-gray-500 focus:border-gray-500 text-sm">
                            <option value="">{{ __('layouts.Default') }}</option>
                            <option value="newest" @selected(request('sort') == 'newest')>
                                {{ __('layouts.Newest_Arrivals') }}
                            </option>
                            <option value="price_asc" @selected(request('sort') == 'price_asc')>
                                {{ __('layouts.Price_Low_to_High') }}
                            </option>
                            <option value="price_desc" @selected(request('sort') == 'price_desc')>
                                {{ __('layouts.Price_High_to_Low') }}
                            </option>
                        </select>
                    </div>

                    <button type="submit"
                        class="w-full bg-gray-800 text-white py-2 rounded-lg text-sm font-medium hover:bg-gray-700 transition">
                        Apply Filters
                    </button>

                    @if(request()->anyFilled(['search', 'category', 'sort']))
                        <a href="{{ route('products.index') }}"
                            class="block text-center text-sm text-gray-500 hover:text-gray-800 mt-2">
                            {{ __('layouts.Clear_Filters') }}
                        </a>
                    @endif
                </form>
            </aside>

            {{-- Products Grid --}}
            <div class="flex-1">
                <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($products as $product)
                        <a href="{{ route('products.show', $product) }}" class="group block">

                            {{-- Primary Image --}}
                            <div class="aspect-square bg-gray-300 border border-gray-600 rounded-xl overflow-hidden mb-3">
                                @if($product->primaryImage)
                                    <img src="{{ Storage::url($product->primaryImage->path) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-black-300 text-sm">
                                        {{ __('layouts.No_image') }}
                                    </div>
                                @endif
                            </div>

                            {{-- Product Info --}}
                            <p class="text-xs text-gray-700 mb-1">{{ $product->category->name }}</p>
                            <h2 class="text-sm font-medium text-gray-800 mb-1 truncate">{{ $product->name }}</h2>
                            <p class="text-sm text-gray-800">EGP {{ number_format($product->price, 2) }}</p>
                        </a>
                    @empty
                        <div
                            class="col-span-full py-20 flex flex-col items-center justify-center text-gray-500 border border-dashed border-gray-500 rounded-xl">
                            <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <p>{{ __('layouts.No_products_found_matching_your_filters') }}</p>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination Links --}}
                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
    </div>

</x-app-layout>