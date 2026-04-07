<x-layouts.app title="Checkout">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Form alamat --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6" x-data="{ addressType: '{{ Auth::user()->address ? 'saved' : 'new' }}' }">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Alamat Pengiriman</h2>
                    <form method="POST" action="{{ route('orders.place') }}" id="checkout-form">
                        @csrf
                        @foreach($selectedItemIds as $itemId)
                            <input type="hidden" name="items[]" value="{{ $itemId }}">
                        @endforeach

                        @if(Auth::user()->address)
                            <div class="space-y-3 mb-4">
                                <label class="flex items-start gap-3 p-3 border rounded-xl cursor-pointer transition-colors" :class="addressType === 'saved' ? 'border-emerald-500 bg-emerald-50/50' : 'border-gray-200 hover:border-gray-300'" @click="addressType = 'saved'">
                                    <input type="radio" name="address_type" value="saved" class="mt-0.5 text-emerald-600 focus:ring-emerald-500" x-model="addressType">
                                    <div class="flex-1">
                                        <span class="text-sm font-semibold text-gray-900">Gunakan alamat tersimpan</span>
                                        <p class="text-xs text-gray-500 mt-1">{{ Auth::user()->address }}</p>
                                    </div>
                                </label>
                                <label class="flex items-start gap-3 p-3 border rounded-xl cursor-pointer transition-colors" :class="addressType === 'new' ? 'border-emerald-500 bg-emerald-50/50' : 'border-gray-200 hover:border-gray-300'" @click="addressType = 'new'">
                                    <input type="radio" name="address_type" value="new" class="mt-0.5 text-emerald-600 focus:ring-emerald-500" x-model="addressType">
                                    <div class="flex-1">
                                        <span class="text-sm font-semibold text-gray-900">Gunakan alamat baru</span>
                                        <p class="text-xs text-gray-500 mt-0.5">Masukkan alamat pengiriman yang berbeda.</p>
                                    </div>
                                </label>
                            </div>
                        @endif

                        <div x-show="addressType === 'saved'" x-cloak>
                            <input type="hidden" name="shipping_address" value="{{ Auth::user()->address }}" :disabled="addressType !== 'saved'">
                        </div>

                        <div x-show="addressType === 'new'">
                            <textarea name="shipping_address" rows="4" placeholder="Masukkan alamat pengiriman lengkap..." class="w-full px-3 py-2 border border-stone-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm" :required="addressType === 'new'" :disabled="addressType !== 'new'">{{ old('shipping_address') }}</textarea>
                        </div>
                        @error('shipping_address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </form>
                </div>

                {{-- Ringkasan item --}}
                <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Ringkasan Pesanan</h2>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @foreach($cartItems as $item)
                            <div class="p-4 flex items-center gap-4">
                                <img src="{{ $item->book->image_url }}" alt="{{ $item->book->title }}" class="w-12 h-16 object-cover rounded">
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-900 text-sm">{{ $item->book->title }}</h3>
                                    <p class="text-xs text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->book->price, 0, ',', '.') }}</p>
                                </div>
                                <p class="font-semibold text-gray-900 text-sm">Rp {{ number_format($item->book->price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Ringkasan total --}}
            <div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-8">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Rincian Pembayaran</h2>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal ({{ $cartItems->sum('quantity') }} item)</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Ongkos Kirim</span>
                            <span class="text-green-600">Gratis</span>
                        </div>
                        <div class="border-t border-gray-200 pt-2 flex justify-between font-bold text-gray-900 text-lg">
                            <span>Total</span>
                            <span class="text-emerald-700">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="mt-4 p-3 bg-green-50 rounded-lg text-xs text-green-800">
                        <div class="flex items-center gap-2 mb-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            <strong>Metode Pembayaran: COD</strong>
                        </div>
                        Pembayaran dilakukan secara tunai saat pesanan diterima di alamat pengiriman Anda.
                    </div>
                    <button type="submit" form="checkout-form" class="mt-4 w-full py-3 bg-emerald-700 text-white rounded-lg hover:bg-emerald-800 transition font-medium text-sm">Buat Pesanan (COD)</button>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
