<x-layouts.app title="Pesanan Saya">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Pesanan Saya</h1>

        @if($orders->count())
            <div class="space-y-4">
                @foreach($orders as $order)
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
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-sm text-gray-500">Pesanan #{{ Str::limit($order->id, 8) }}</p>
                                <p class="text-xs text-gray-400">{{ $order->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <span class="px-3 py-1 text-xs font-medium rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100' }}">{{ $statusLabels[$order->status] ?? $order->status }}</span>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($order->orderItems->take(3) as $item)
                                <div class="flex items-center gap-2 bg-gray-50 rounded-lg px-3 py-2">
                                    <span class="text-sm text-gray-700">{{ $item->book->title }}</span>
                                    <span class="text-xs text-gray-500">x{{ $item->quantity }}</span>
                                </div>
                            @endforeach
                            @if($order->orderItems->count() > 3)
                                <span class="text-sm text-gray-500 self-center">+{{ $order->orderItems->count() - 3 }} lainnya</span>
                            @endif
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-lg font-bold text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            <a href="{{ route('orders.show', $order) }}" class="text-sm text-emerald-700 hover:text-emerald-800 font-medium">Lihat Detail &rarr;</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">{{ $orders->links() }}</div>
        @else
            <div class="text-center py-16 bg-white rounded-xl shadow-sm border border-gray-200">
                <svg class="mx-auto w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada pesanan</h3>
                <p class="mt-2 text-gray-600">Mulai berbelanja dan pesanan Anda akan muncul di sini.</p>
                <a href="{{ route('books.index') }}" class="mt-4 inline-block px-6 py-2 bg-emerald-700 text-white rounded-lg hover:bg-emerald-800 transition text-sm font-medium">Lihat Katalog</a>
            </div>
        @endif
    </div>
</x-layouts.app>
