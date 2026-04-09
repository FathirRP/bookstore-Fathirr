<x-layouts.admin title="Laporan" header="Laporan Penjualan & Keuangan">
    <div class="space-y-6">
        <section class="bg-white rounded-[28px] border border-slate-200/70 p-6 shadow-sm shadow-slate-200/40">
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">
                <div>
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-[0.24em] bg-slate-100 text-slate-500">Ringkasan Bisnis</span>
                    <h2 class="mt-3 text-2xl font-bold text-slate-900">Pantau penjualan, arus kas COD, dan performa buku.</h2>
                    <p class="mt-2 text-sm text-slate-500 max-w-2xl">Periode aktif: <span class="font-semibold text-slate-700">{{ $reportPeriodLabel }}</span></p>
                </div>

                <form method="GET" action="{{ route('admin.reports.index') }}" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-[1fr_1fr_auto_auto] gap-3 w-full lg:w-auto lg:min-w-[640px]">
                    <div>
                        <label for="from_date" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Dari</label>
                        <input type="date" name="from_date" id="from_date" value="{{ $filters['from_date'] }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                    </div>
                    <div>
                        <label for="to_date" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Sampai</label>
                        <input type="date" name="to_date" id="to_date" value="{{ $filters['to_date'] }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                    </div>
                    <button type="submit" class="sm:self-end inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-2xl bg-slate-900 text-white text-sm font-semibold hover:bg-slate-800 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4.5h18M7.5 12h9m-7.5 7.5h6"/></svg>
                        Terapkan Filter
                    </button>
                    <a href="{{ route('admin.reports.index') }}" class="sm:self-end inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-2xl bg-slate-100 text-slate-700 text-sm font-semibold hover:bg-slate-200 transition-colors">
                        Reset
                    </a>
                </form>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
            @php
                $summaryCards = [
                    [
                        'label' => 'Omzet Kotor',
                        'value' => 'Rp ' . number_format($reportSummary['grossRevenue'], 0, ',', '.'),
                        'caption' => $reportSummary['totalOrders'] . ' pesanan masuk',
                        'theme' => 'from-sky-50 to-blue-50 border-sky-100 text-sky-700',
                        'iconBg' => 'bg-white/80 text-sky-700',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8c-2.761 0-5 1.567-5 3.5s2.239 3.5 5 3.5 5-1.567 5-3.5S14.761 8 12 8zm0 0V5m0 10v4m-7-7H3m18 0h-2"/>',
                    ],
                    [
                        'label' => 'Kas Masuk',
                        'value' => 'Rp ' . number_format($reportSummary['collectedRevenue'], 0, ',', '.'),
                        'caption' => $reportSummary['collectionRate'] . '% dari omzet sudah selesai',
                        'theme' => 'from-emerald-50 to-green-50 border-emerald-100 text-emerald-700',
                        'iconBg' => 'bg-white/80 text-emerald-700',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12.75l2.25 2.25L15 9.75m6 2.25a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                    ],
                    [
                        'label' => 'Piutang COD',
                        'value' => 'Rp ' . number_format($reportSummary['outstandingRevenue'], 0, ',', '.'),
                        'caption' => 'Diproses + dikirim belum jadi kas',
                        'theme' => 'from-amber-50 to-orange-50 border-amber-100 text-amber-700',
                        'iconBg' => 'bg-white/80 text-amber-700',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6v6l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                    ],
                    [
                        'label' => 'Item Terjual',
                        'value' => number_format($reportSummary['itemsSold'], 0, ',', '.'),
                        'caption' => 'AOV Rp ' . number_format($reportSummary['averageOrderValue'], 0, ',', '.'),
                        'theme' => 'from-fuchsia-50 to-violet-50 border-fuchsia-100 text-fuchsia-700',
                        'iconBg' => 'bg-white/80 text-fuchsia-700',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.5 6.75h15m-15 0l1.5 10.5A2.25 2.25 0 008.227 19.5h7.546a2.25 2.25 0 002.227-2.25l1.5-10.5M9 10.5h6"/>',
                    ],
                ];
            @endphp

            @foreach($summaryCards as $card)
                <article class="rounded-[26px] border bg-gradient-to-br {{ $card['theme'] }} p-5 shadow-sm shadow-slate-200/40">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-slate-500">{{ $card['label'] }}</p>
                            <p class="mt-4 text-3xl font-extrabold text-slate-900 tracking-tight">{{ $card['value'] }}</p>
                            <p class="mt-2 text-sm text-slate-500">{{ $card['caption'] }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-2xl {{ $card['iconBg'] }} flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $card['icon'] !!}</svg>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>

        <section class="grid grid-cols-1 xl:grid-cols-[1.4fr_1fr] gap-6">
            <div class="bg-white rounded-[28px] border border-slate-200/70 p-6 shadow-sm shadow-slate-200/40">
                <div class="flex items-start justify-between gap-4 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Tren Omzet</h3>
                        <p class="text-sm text-slate-500 mt-1">Perbandingan omzet kotor dan kas masuk per bulan.</p>
                    </div>
                    <div class="flex items-center gap-3 text-xs font-semibold text-slate-500">
                        <span class="inline-flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-slate-900"></span>Omzet</span>
                        <span class="inline-flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>Kas Masuk</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 items-end min-h-[240px]">
                    @foreach($monthlyTrend as $month)
                        <div class="flex flex-col justify-end h-full">
                            <div class="flex items-end justify-center gap-2 h-44">
                                <div class="w-5 rounded-t-2xl bg-slate-900/90" style="height: {{ $month['percentage'] }}%"></div>
                                <div class="w-5 rounded-t-2xl bg-emerald-500" style="height: {{ $month['collectedRevenue'] > 0 ? max(8, (int) round(($month['collectedRevenue'] / max(1, $reportSummary['grossRevenue'], $month['grossRevenue'])) * 100)) : 0 }}%"></div>
                            </div>
                            <div class="mt-4 text-center">
                                <p class="text-sm font-semibold text-slate-700">{{ $month['label'] }}</p>
                                <p class="text-xs text-slate-400 mt-1">{{ $month['orderCount'] }} pesanan</p>
                                <p class="text-xs text-slate-500 mt-2">Rp {{ number_format($month['grossRevenue'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-[28px] border border-slate-200/70 p-6 shadow-sm shadow-slate-200/40">
                <div class="mb-5">
                    <h3 class="text-lg font-bold text-slate-900">Komposisi Status</h3>
                    <p class="text-sm text-slate-500 mt-1">Distribusi order terhadap arus kas COD.</p>
                </div>

                <div class="space-y-4">
                    @foreach($statusBreakdown as $status)
                        <div class="rounded-2xl border border-slate-100 p-4 bg-slate-50/60">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $status['badge'] }}">{{ $status['label'] }}</span>
                                    <p class="mt-2 text-sm font-semibold text-slate-800">{{ $status['count'] }} pesanan</p>
                                    <p class="text-xs text-slate-500 mt-1">{{ $status['description'] }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-slate-900">Rp {{ number_format($status['amount'], 0, ',', '.') }}</p>
                                    <p class="text-xs text-slate-400 mt-1">{{ $status['percentage'] }}%</p>
                                </div>
                            </div>
                            <div class="mt-4 h-2.5 rounded-full bg-white overflow-hidden">
                                <div class="h-full rounded-full {{ $status['bar'] }}" style="width: {{ $status['percentage'] }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 xl:grid-cols-[1.1fr_1.2fr] gap-6">
            <div class="bg-white rounded-[28px] border border-slate-200/70 p-6 shadow-sm shadow-slate-200/40">
                <div class="mb-5">
                    <h3 class="text-lg font-bold text-slate-900">Buku Paling Laris</h3>
                    <p class="text-sm text-slate-500 mt-1">Berdasarkan jumlah item terjual pada periode aktif.</p>
                </div>

                <div class="space-y-3">
                    @forelse($topBooks as $index => $book)
                        <div class="flex items-center justify-between gap-4 rounded-2xl border border-slate-100 bg-slate-50/70 px-4 py-3">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-10 h-10 rounded-2xl bg-slate-900 text-white text-sm font-bold flex items-center justify-center shrink-0">{{ $index + 1 }}</div>
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-slate-900 truncate">{{ $book->title }}</p>
                                    <p class="text-xs text-slate-400 truncate">{{ $book->author ?: 'Penulis belum diisi' }}</p>
                                </div>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="text-sm font-bold text-slate-900">{{ number_format($book->total_quantity, 0, ',', '.') }} item</p>
                                <p class="text-xs text-emerald-600 mt-1">Rp {{ number_format($book->total_revenue, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50/60 px-5 py-10 text-center">
                            <p class="text-sm font-medium text-slate-500">Belum ada data penjualan pada periode ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-[28px] border border-slate-200/70 overflow-hidden shadow-sm shadow-slate-200/40">
                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Transaksi Terbaru</h3>
                        <p class="text-sm text-slate-500 mt-1">Detail order untuk audit penjualan dan kas.</p>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 text-slate-700 text-xs font-semibold hover:bg-slate-200 transition-colors">
                        Lihat Pesanan
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-slate-50/80">
                                <th class="px-6 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">Pesanan</th>
                                <th class="px-6 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">Pelanggan</th>
                                <th class="px-6 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">Status</th>
                                <th class="px-6 py-3 text-right text-[11px] font-bold uppercase tracking-wider text-slate-400">Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($recentOrders as $order)
                                @php
                                    $statusClasses = [
                                        'PROCESSING' => 'bg-blue-50 text-blue-700 border-blue-100',
                                        'SHIPPED' => 'bg-sky-50 text-sky-700 border-sky-100',
                                        'COMPLETED' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                    ];
                                    $statusLabels = [
                                        'PROCESSING' => 'Diproses',
                                        'SHIPPED' => 'Dikirim',
                                        'COMPLETED' => 'Selesai',
                                    ];
                                @endphp
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="text-sm font-semibold text-slate-800 hover:text-emerald-600 transition-colors">#{{ Str::limit($order->id, 8) }}</a>
                                        <p class="text-xs text-slate-400 mt-1">{{ $order->created_at->format('d M Y H:i') }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-slate-700">{{ $order->user->name }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full border text-[11px] font-bold {{ $statusClasses[$order->status] ?? 'bg-slate-50 text-slate-700 border-slate-100' }}">
                                            {{ $statusLabels[$order->status] ?? $order->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-sm font-bold text-slate-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center text-sm font-medium text-slate-400">Belum ada transaksi pada periode ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</x-layouts.admin>