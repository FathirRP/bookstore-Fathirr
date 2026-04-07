<x-layouts.admin title="Dasbor" header="Dasbor">
    {{-- Welcome Banner --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-emerald-900 rounded-2xl p-6 sm:p-8 mb-8">
        <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-emerald-400/10 rounded-full blur-2xl translate-y-1/2 -translate-x-1/4"></div>
        <div class="relative z-10">
            <p class="text-emerald-400 text-sm font-semibold mb-1">Selamat datang kembali 👋</p>
            <h2 class="text-xl sm:text-2xl font-bold text-white">{{ auth()->user()->name ?? 'Admin' }}</h2>
            <p class="text-slate-400 text-sm mt-1.5">Pantau dan kelola toko bukumu dari sini.</p>
        </div>
    </div>

    {{-- Statistics Cards --}}
    @php
        $cards = [
            ['label' => 'Total Buku', 'value' => $stats['totalBooks'], 'color' => 'emerald', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>'],
            ['label' => 'Total Kategori', 'value' => $stats['totalCategories'], 'color' => 'violet', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 6h.008v.008H6V6z"/>'],
            ['label' => 'Total Pengguna', 'value' => $stats['totalUsers'], 'color' => 'blue', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>'],
            ['label' => 'Total Pesanan', 'value' => $stats['totalOrders'], 'color' => 'amber', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>'],
            ['label' => 'Menunggu Diproses', 'value' => $stats['pendingOrders'], 'color' => 'rose', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>'],
            ['label' => 'Total Pesan', 'value' => $stats['totalMessages'], 'color' => 'teal', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>'],
        ];
        $colorMap = [
            'emerald' => ['bg' => 'bg-emerald-50', 'icon' => 'bg-emerald-100 text-emerald-600', 'ring' => 'ring-emerald-500/20'],
            'violet'  => ['bg' => 'bg-violet-50', 'icon' => 'bg-violet-100 text-violet-600', 'ring' => 'ring-violet-500/20'],
            'blue'    => ['bg' => 'bg-blue-50', 'icon' => 'bg-blue-100 text-blue-600', 'ring' => 'ring-blue-500/20'],
            'amber'   => ['bg' => 'bg-amber-50', 'icon' => 'bg-amber-100 text-amber-600', 'ring' => 'ring-amber-500/20'],
            'rose'    => ['bg' => 'bg-rose-50', 'icon' => 'bg-rose-100 text-rose-600', 'ring' => 'ring-rose-500/20'],
            'teal'    => ['bg' => 'bg-teal-50', 'icon' => 'bg-teal-100 text-teal-600', 'ring' => 'ring-teal-500/20'],
        ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5 mb-8">
        @foreach($cards as $i => $card)
            @php $c = $colorMap[$card['color']]; @endphp
            <div class="group bg-white rounded-2xl border border-slate-200/60 p-5 sm:p-6 hover:shadow-lg hover:shadow-slate-200/50 hover:-translate-y-0.5 transition-all duration-300" style="animation-delay: {{ $i * 80 }}ms">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">{{ $card['label'] }}</p>
                        <p class="text-3xl font-extrabold text-slate-900 mt-2 tracking-tight">{{ $card['value'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl {{ $c['icon'] }} flex items-center justify-center ring-4 {{ $c['ring'] }} group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $card['icon'] !!}</svg>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Recent Orders Table --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Pesanan Terbaru</h2>
                <p class="text-xs text-slate-400 mt-0.5">Daftar pesanan yang baru masuk</p>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 hover:text-emerald-700 bg-emerald-50 hover:bg-emerald-100 px-3.5 py-2 rounded-xl transition-colors">
                Lihat Semua
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50/80">
                        <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">ID Pesanan</th>
                        <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-sm font-mono font-semibold text-emerald-600 hover:text-emerald-700 hover:underline decoration-emerald-300 underline-offset-2">
                                    #{{ Str::limit($order->id, 8) }}
                                </a>
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
                                <span class="inline-flex items-center px-2.5 py-1 text-[11px] font-bold rounded-lg ring-1 ring-inset {{ $statusStyles[$order->status] ?? 'bg-slate-50 text-slate-700 ring-slate-600/10' }}">
                                    {{ $statusLabels[$order->status] ?? $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-400">{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mb-3">
                                        <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                                    </div>
                                    <p class="text-sm font-medium text-slate-400">Belum ada pesanan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
