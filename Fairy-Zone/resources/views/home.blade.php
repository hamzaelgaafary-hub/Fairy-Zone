<x-app-layout title="Fairy Zone — Cosmetics">
    {{-- Hero --}}
    <section class="bg-gray-100 py-20 text-center">
        <div class="max-w-2xl mx-auto px-4">
            <p class="text-sm text-gray-400 mb-2">New arrivals</p>
            <h1 class="text-3xl font-medium text-gray-800 mb-4">
                Your daily glow routine
            </h1>
            <p class="text-gray-500 mb-8">
                Natural skincare & makeup, delivered to your door
            </p>
            <a href="{{ route('products.index') }}" class="bg-gray-800 text-white px-8 py-3 rounded-lg text-sm">
                Shop now
            </a>
        </div>
    </section>

    {{-- Categories --}}
    <section class="max-w-6xl mx-auto px-4 py-10">
        <div class="flex gap-3 flex-wrap">
            <a href="{{ route('products.index') }}"
                class="px-4 py-2 border border-gray-800 rounded-full text-sm text-gray-800">
                All
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('products.index', ['category' => $cat->id]) }}"
                    class="px-4 py-2 border border-gray-200 rounded-full text-sm text-gray-500 hover:border-gray-800 hover:text-gray-800 transition">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </section>

    {{-- Featured Products --}}
    <section class="max-w-6xl mx-auto px-4 pb-16">
        <h2 class="text-lg font-medium text-gray-800 mb-6">Featured products</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($featured as $product)
                <a href="{{ route('products.show', $product->slug) }}"
                    class="bg-white border border-gray-100 rounded-xl overflow-hidden hover:shadow-sm transition">

                    {{-- Image --}}
                    <div class="aspect-square bg-gray-50 flex items-center justify-center">
                        @if($product->primaryImage)
                            <img src="{{ Storage::url($product->primaryImage->path) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M4 16l4-4 4 4 4-8 4 8" />
                            </svg>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="p-3">
                        <p class="text-sm font-medium text-gray-800 truncate">{{ $product->name }}</p>
                        <p class="text-sm text-gray-400 mt-1">{{ $product->category->name }}</p>
                        <p class="text-sm font-medium text-gray-800 mt-1">
                            EGP {{ number_format($product->price, 2) }}
                        </p>
                    </div>
                </a>
            @empty
                <p class="text-gray-400 col-span-4">No featured products yet.</p>
            @endforelse
        </div>
    </section>

</x-app-layout>