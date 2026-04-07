<x-layouts.admin title="Detail Pesanan" header="Detail Pesanan">
    <div class="max-w-4xl">
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-500 hover:text-slate-700 mb-5 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Daftar Pesanan
        </a>

        <div class="space-y-5">
            {{-- Order info --}}
            <div class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-base font-bold text-slate-800">Informasi Pesanan</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">ID Pesanan</p>
                            <p class="mt-1.5 text-sm font-mono font-semibold text-slate-800">{{ $order->id }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Pelanggan</p>
                            <div class="mt-1.5 flex items-center gap-2">
                                <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center text-white text-[10px] font-bold">
                                    {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-800">{{ $order->user->name }}</p>
                                    <p class="text-[11px] text-slate-400">{{ $order->user->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Pembayaran</p>
                            <p class="mt-1.5 text-xl font-extrabold text-emerald-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tanggal Pesanan</p>
                            <p class="mt-1.5 text-sm text-slate-700">{{ $order->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Alamat Pengiriman</p>
                            <p class="mt-1.5 text-sm text-slate-700 bg-slate-50 rounded-xl px-4 py-3">{{ $order->shipping_address }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Update status --}}
            <div class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-base font-bold text-slate-800">Perbarui Status</h3>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" class="flex items-center gap-4">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                            @foreach(['PROCESSING', 'SHIPPED', 'COMPLETED'] as $status)
                                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white text-sm font-semibold rounded-xl hover:from-emerald-700 hover:to-emerald-800 transition-all shadow-sm shadow-emerald-500/20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182"/></svg>
                            Perbarui Status
                        </button>
                    </form>
                </div>
            </div>

            {{-- Order items --}}
            <div class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-base font-bold text-slate-800">Item Pesanan</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-slate-50/80">
                                <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Buku</th>
                                <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Harga</th>
                                <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Jumlah</th>
                                <th class="px-6 py-3.5 text-right text-[11px] font-bold text-slate-400 uppercase tracking-wider">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($order->orderItems as $item)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-semibold text-slate-800">{{ $item->book->title }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-600">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-sm font-bold text-slate-700">{{ $item->quantity }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-slate-900 text-right">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
