<x-app-layout :title="$product->name . ' — Fairy Zone'">

    <div class="max-w-5xl mx-auto px-4 py-10">

        {{-- Breadcrumb --}}
        <nav class="text-sm text-gray-600 mb-8 flex gap-2">
            <a href="{{ route('home') }}" class="hover:text-gray-600">{{ __('layouts.home') }}</a>
            <span>/</span>
            <a href="{{ route('products.index', ['category' => $product->category_id]) }}"
                class="hover:text-gray-600">{{ $product->category->name }}</a>
            <span>/</span>
            <span class="text-gray-600">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            {{-- Images --}}
            <div>
                {{-- Main Image --}}
                <div class="aspect-square bg-gray-150 border border-gray-400 rounded-xl overflow-hidden mb-3">
                    @if($product->images->count())
                        <img id="main-image"
                            src="{{ Storage::url($product->images->where('is_primary', true)->first()?->path ?? $product->images->first()->path) }}"
                            alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-700 text-sm">
                            {{ __('layouts.No_image') }}
                        </div>
                    @endif
                </div>

                {{-- Thumbnails --}}
                @if($product->images->count() > 1)
                    <div class="flex gap-2">
                        @foreach($product->images as $image)
                            <button onclick="document.getElementById('main-image').src='{{ Storage::url($image->path) }}'"
                                class="w-16 h-16 rounded-lg border border-gray-100 overflow-hidden hover:border-gray-400 transition">
                                <img src="{{ Storage::url($image->path) }}" alt="" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Info --}}
            <div>
                <p class="text-sm text-gray-600 mb-1">{{ $product->category->name }}</p>
                <h1 class="text-2xl font-medium text-gray-800 mb-2">{{ $product->name }}</h1>
                <p class="text-2xl text-gray-800 mb-6">EGP {{ number_format($product->price, 2) }}</p>

                {{-- Stock --}}
                @if($product->isInStock())
                    <p class="text-sm text-green-600 mb-6">
                        {{ __('layouts.In_stock') }} ({{ $product->stock }} {{ __('layouts.available') }})
                    </p>
                @else
                    <p class="text-sm text-red-400 mb-6">{{ __('layouts.Out_of_stock') }}</p>
                @endif

                {{-- Add to Cart Form --}}
                @if($product->isInStock())
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        {{-- Quantity --}}
                        <div class="flex items-center gap-3 mb-4">
                            <label class="text-sm text-gray-600">Quantity</label>
                            <div class="flex items-center border border-gray-500 rounded-lg">
                                <button type="button" onclick="updateQty(-1)"
                                    class="w-9 h-9 flex items-center justify-center text-gray-500 hover:text-gray-800">
                                    −
                                </button>
                                <input type="number" id="quantity" name="quantity" value="1" min="1"
                                    max="{{ $product->stock }}" class="w-10 text-center text-sm border-0 focus:ring-0">
                                <button type="button" onclick="updateQty(1)"
                                    class="w-9 h-9 flex items-center justify-center text-gray-500 hover:text-gray-800">
                                    +
                                </button>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-gray-800 text-white py-3 rounded-xl text-sm font-medium hover:bg-gray-700 transition">
                            {{ __('layouts.Add_to_Cart') }}
                        </button>
                    </form>
                @endif

                {{-- Success message --}}
                @if(session('success'))
                    <p class="mt-3 text-sm text-green-600">{{ session('success') }}</p>
                @endif

                {{-- Description --}}
                @if($product->description)
                    <div class="mt-8 pt-8 border-t border-gray-100">
                        <h2 class="text-sm font-medium text-gray-1000 mb-3">{{ __('layouts.Description') }}</h2>
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $product->description }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function updateQty(change) {
            const input = document.getElementById('quantity');
            const max = parseInt(input.max);
            const newVal = parseInt(input.value) + change;
            if (newVal >= 1 && newVal <= max) input.value = newVal;
        }
    </script>

</x-app-layout>