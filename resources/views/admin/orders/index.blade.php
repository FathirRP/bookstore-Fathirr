<x-layouts.admin title="Pesanan" header="Manajemen Pesanan">
    <div class="mb-6">
        <p class="text-sm text-slate-400">Pantau dan kelola semua pesanan pelanggan</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50/80">
                        <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">ID Pesanan</th>
                        <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3.5 text-right text-[11px] font-bold text-slate-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($orders as $order)
                        @php
                            $statusStyles = [
                                'PROCESSING' => 'bg-blue-50 text-blue-700 ring-blue-600/10',
                                'SHIPPED' => 'bg-sky-50 text-sky-700 ring-sky-600/10',
                                'COMPLETED' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/10',
                            ];
                            $statusLabels = [
                                'PROCESSING' => 'Diproses',
                                'SHIPPED' => 'Dikirim',
                                'COMPLETED' => 'Selesai',
                            ];
                        @endphp
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <span class="text-sm font-mono font-semibold text-slate-700">#{{ Str::limit($order->id, 8) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center text-white text-xs font-bold">
                                        {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                    </div>
                                    <span class="text-sm font-medium text-slate-700">{{ $order->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 text-[11px] font-bold rounded-lg ring-1 ring-inset {{ $statusStyles[$order->status] ?? 'bg-slate-50 text-slate-700 ring-slate-600/10' }}">
                                    {{ $statusLabels[$order->status] ?? $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-400">{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition-colors opacity-60 group-hover:opacity-100">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mb-3">
                                        <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z"/></svg>
                                    </div>
                                    <p class="text-sm font-medium text-slate-400">Belum ada pesanan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">{{ $orders->links() }}</div>
        @endif
    </div>
</x-layouts.admin>
