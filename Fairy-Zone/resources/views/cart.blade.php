<!-- resources/views/cart.blade.php -->
<x-app-layout title="Cart — Fairy Zone">

    <div class="max-w-4xl mx-auto px-4 py-10">

        <h1 class="text-xl font-medium text-gray-800 mb-8">
            Your cart ({{ count($cart) }} items)
        </h1>

        @if(empty($cart))
            <div class="text-center py-20">
                <p class="text-gray-400 mb-4">Your cart is empty.</p>
                <a href="{{ route('products.index') }}" class="bg-gray-800 text-white px-6 py-2.5 rounded-lg text-sm">
                    Browse products
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Items --}}
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cart as $item)
                        <div class="bg-white border border-gray-100 rounded-xl p-4 flex gap-4">

                            {{-- Image --}}
                            <div class="w-20 h-20 bg-gray-50 rounded-lg flex-shrink-0 overflow-hidden border border-gray-100">
                                @if($item['image'])
                                    <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}"
                                        class="w-full h-full object-cover">
                                @endif
                            </div>

                            {{-- Details --}}
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800">{{ $item['name'] }}</p>
                                <p class="text-sm text-gray-400 mt-1">
                                    EGP {{ number_format($item['price'], 2) }}
                                </p>

                                <div class="flex items-center justify-between mt-3">

                                    {{-- Quantity Update --}}
                                    <form action="{{ route('cart.update') }}" method="POST"
                                        class="flex items-center border border-gray-200 rounded-lg">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                        <button type="button" onclick="updateQty(this, -1)"
                                            class="w-8 h-8 text-gray-500 hover:text-gray-800">−</button>
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                            onchange="this.closest('form').submit()"
                                            class="w-10 text-center text-sm border-0 focus:ring-0">
                                        <button type="button" onclick="updateQty(this, 1)"
                                            class="w-8 h-8 text-gray-500 hover:text-gray-800">+</button>
                                    </form>

                                    {{-- Subtotal --}}
                                    <p class="text-sm font-medium text-gray-800">
                                        EGP {{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </p>

                                    {{-- Remove --}}
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                        <button type="submit" class="text-gray-300 hover:text-red-400 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Summary --}}
                <div class="lg:col-span-1">
                    <div class="bg-white border border-gray-100 rounded-xl p-5 sticky top-24">
                        <h2 class="text-sm font-medium text-gray-800 mb-4">Order summary</h2>

                        <div class="space-y-2 text-sm text-gray-500">
                            <div class="flex justify-between">
                                <span>Subtotal</span>
                                <span>EGP {{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Shipping</span>
                                <span>EGP 50.00</span>
                            </div>
                        </div>

                        <div
                            class="flex justify-between text-sm font-medium text-gray-800 pt-4 mt-4 border-t border-gray-100">
                            <span>Total</span>
                            <span>EGP {{ number_format($total + 50, 2) }}</span>
                        </div>

                        @auth
                            <a href="{{ route('checkout') }}"
                                class="block w-full bg-gray-800 text-white text-center py-3 rounded-xl text-sm font-medium mt-5 hover:bg-gray-700 transition">
                                Proceed to checkout
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="block w-full bg-gray-800 text-white text-center py-3 rounded-xl text-sm font-medium mt-5 hover:bg-gray-700 transition">
                                Login to checkout
                            </a>
                        @endauth

                        <a href="{{ route('products.index') }}"
                            class="block text-center text-sm text-gray-400 mt-3 hover:text-gray-600">
                            Continue shopping
                        </a>
                    </div>
                </div>

            </div>
        @endif

    </div>

    <script>
        function updateQty(btn, change) {
            const form = btn.closest('form');
            const input = form.querySelector('input[name="quantity"]');
            const newVal = parseInt(input.value) + change;
            if (newVal >= 1) {
                input.value = newVal;
                form.submit();
            }
        }
    </script>

</x-app-layout>