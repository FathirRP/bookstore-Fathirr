<x-layouts.app title="Detail Pesanan">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <nav class="mb-6 text-sm text-gray-500">
            <a href="{{ route('orders.index') }}" class="hover:text-emerald-700">Pesanan Saya</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">Detail Pesanan</span>
        </nav>

        @php
            $statusColors = [
                'PROCESSING' => 'bg-blue-100 text-blue-800',
                'SHIPPED' => 'bg-sky-100 text-sky-800',
                'COMPLETED' => 'bg-green-100 text-green-800',
            ];
            $statusLabels = [
                'PROCESSING' => 'Diproses',
                'SHIPPED' => 'Dikirim',
                'COMPLETED' => 'Selesai',
            ];
        @endphp

        {{-- Info pesanan --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-2xl font-bold text-gray-900">Pesanan #{{ Str::limit($order->id, 8) }}</h1>
                <div class="flex items-center gap-3">
                    <a href="{{ route('orders.invoice', $order) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-700 text-white text-xs font-medium rounded-lg hover:bg-emerald-800 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        Cetak Invoice
                    </a>
                    <span class="px-3 py-1 text-sm font-medium rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100' }}">{{ $statusLabels[$order->status] ?? $order->status }}</span>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Tanggal Pesanan</p>
                    <p class="font-medium text-gray-900">{{ $order->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Alamat Pengiriman</p>
                    <p class="font-medium text-gray-900">{{ $order->shipping_address }}</p>
                </div>
            </div>
        </div>

        @if($order->status !== 'COMPLETED')
        <div class="bg-green-50 border border-green-200 rounded-xl p-6 mb-6">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <h3 class="font-semibold text-green-800">Pembayaran: COD (Bayar di Tempat)</h3>
            </div>
            <p class="text-sm text-green-700">Siapkan pembayaran tunai sebesar <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong> saat pesanan tiba di alamat Anda.</p>
        </div>
        @endif

        {{-- Item pesanan --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Item Pesanan</h2>
            </div>
            <div class="divide-y divide-gray-200">
                @foreach($order->orderItems as $item)
                    <div class="p-4 flex items-center gap-4">
                        <img src="{{ $item->book->image_url }}" alt="{{ $item->book->title }}" class="w-12 h-16 object-cover rounded">
                        <div class="flex-1">
                            <h3 class="font-medium text-gray-900">{{ $item->book->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                        <p class="font-semibold text-gray-900">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center rounded-b-xl">
                <span class="text-gray-600 font-medium">Total</span>
                <span class="text-xl font-bold text-emerald-700">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</x-layouts.app>
