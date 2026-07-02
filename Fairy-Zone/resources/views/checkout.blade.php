
<!-- resources/views/checkout.blade.php -->
<x-app-layout title="Checkout — Fairy Zone">

    <div class="max-w-4xl mx-auto px-4 py-10">

        <h1 class="text-xl font-medium text-gray-800 mb-8">Checkout</h1>

        <form action="{{ route('order.place') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Left: Shipping + Payment --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Errors --}}
                    @if($errors->any())
                        <div class="bg-red-50 border border-red-100 rounded-xl p-4">
                            <ul class="text-sm text-red-500 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Shipping Info --}}
                    <div class="bg-white border border-gray-100 rounded-xl p-5">
                        <h2 class="text-sm font-medium text-gray-800 mb-4">Shipping info</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div>
                                <label class="text-xs text-gray-500 block mb-1">Full name</label>
                                <input type="text" name="shipping_name"
                                       value="{{ old('shipping_name', $address?->name ?? auth()->user()->name) }}"
                                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-gray-400">
                            </div>

                            <div>
                                <label class="text-xs text-gray-500 block mb-1">Phone</label>
                                <input type="text" name="shipping_phone"
                                       value="{{ old('shipping_phone', $address?->phone) }}"
                                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-gray-400">
                            </div>

                            <div class="md:col-span-2">
                                <label class="text-xs text-gray-500 block mb-1">Address</label>
                                <input type="text" name="shipping_address"
                                       value="{{ old('shipping_address', $address?->address) }}"
                                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-gray-400">
                            </div>

                            <div>
                                <label class="text-xs text-gray-500 block mb-1">City</label>
                                <input type="text" name="shipping_city"
                                       value="{{ old('shipping_city', $address?->city) }}"
                                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-gray-400">
                            </div>

                            <div>
                                <label class="text-xs text-gray-500 block mb-1">Governorate</label>
                                <input type="text" name="shipping_governorate"
                                       value="{{ old('shipping_governorate', $address?->governorate) }}"
                                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-gray-400">
                            </div>

                            <div class="md:col-span-2">
                                <label class="text-xs text-gray-500 block mb-1">Notes (optional)</label>
                                <textarea name="notes" rows="2"
                                          class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-gray-400">{{ old('notes') }}</textarea>
                            </div>

                        </div>
                    </div>

                    {{-- Payment Method --}}
                    <div class="bg-white border border-gray-100 rounded-xl p-5">
                        <h2 class="text-sm font-medium text-gray-800 mb-4">Payment method</h2>

                        <div class="space-y-3">
                            <label class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg cursor-pointer has-[:checked]:border-gray-800">
                                <input type="radio" name="payment_method" value="cod"
                                       {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }}
                                       class="accent-gray-800">
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Cash on delivery</p>
                                    <p class="text-xs text-gray-400">Pay when you receive your order</p>
                                </div>
                            </label>

                            <label class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg cursor-pointer has-[:checked]:border-gray-800">
                                <input type="radio" name="payment_method" value="online"
                                       {{ old('payment_method') === 'online' ? 'checked' : '' }}
                                       class="accent-gray-800">
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Online payment</p>
                                    <p class="text-xs text-gray-400">Paymob — card or wallet</p>
                                </div>
                            </label>
                        </div>
                    </div>

                </div>

                {{-- Right: Order Summary --}}
                <div class="lg:col-span-1">
                    <div class="bg-white border border-gray-100 rounded-xl p-5 sticky top-24">

                        <h2 class="text-sm font-medium text-gray-800 mb-4">Order summary</h2>

                        <div class="space-y-3 mb-4">
                            @foreach($cart as $item)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">
                                        {{ $item['name'] }}
                                        <span class="text-gray-400">× {{ $item['quantity'] }}</span>
                                    </span>
                                    <span class="text-gray-800">
                                        EGP {{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t border-gray-100 pt-4 space-y-2 text-sm text-gray-500">
                            <div class="flex justify-between">
                                <span>Subtotal</span>
                                <span>EGP {{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Shipping</span>
                                <span>EGP 50.00</span>
                            </div>
                            <div class="flex justify-between font-medium text-gray-800 pt-2 border-t border-gray-100">
                                <span>Total</span>
                                <span>EGP {{ number_format($total + 50, 2) }}</span>
                            </div>
                        </div>

                        <button type="submit"
                                class="w-full bg-gray-800 text-white py-3 rounded-xl text-sm font-medium mt-5 hover:bg-gray-700 transition">
                            Place order
                        </button>

                    </div>
                </div>

            </div>
        </form>

    </div>

</x-app-layout>