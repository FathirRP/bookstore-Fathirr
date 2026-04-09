<x-layouts.admin title="Dasbor" header="Dasbor">
    @php
        $cards = [
            ['label' => 'Total Buku', 'value' => number_format($stats['totalBooks'], 0, ',', '.'), 'caption' => 'Produk siap jual', 'line' => 'from-sky-500 via-blue-500 to-cyan-400', 'iconWrap' => 'bg-sky-50 text-sky-700 ring-sky-100', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>'],
            ['label' => 'Total Pengguna', 'value' => number_format($stats['totalUsers'], 0, ',', '.'), 'caption' => 'Akun pelanggan', 'line' => 'from-emerald-500 via-teal-500 to-lime-400', 'iconWrap' => 'bg-emerald-50 text-emerald-700 ring-emerald-100', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>'],
            ['label' => 'Total Pesanan', 'value' => number_format($stats['totalOrders'], 0, ',', '.'), 'caption' => 'Riwayat transaksi', 'line' => 'from-cyan-500 via-sky-500 to-blue-400', 'iconWrap' => 'bg-cyan-50 text-cyan-700 ring-cyan-100', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z"/>'],
            ['label' => 'Kategori', 'value' => number_format($stats['totalCategories'], 0, ',', '.'), 'caption' => 'Segmentasi katalog', 'line' => 'from-violet-500 via-indigo-500 to-fuchsia-400', 'iconWrap' => 'bg-violet-50 text-violet-700 ring-violet-100', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M6 6h.008v.008H6V6z"/>'],
            ['label' => 'Pesan Masuk', 'value' => number_format($stats['totalMessages'], 0, ',', '.'), 'caption' => 'Interaksi pelanggan', 'line' => 'from-rose-500 via-pink-500 to-fuchsia-400', 'iconWrap' => 'bg-rose-50 text-rose-700 ring-rose-100', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951"/>'],
        ];
        $quickActions = [
            ['label' => 'Kelola Buku', 'caption' => 'Tambah, edit, dan cek stok katalog.', 'route' => route('admin.books.index'), 'theme' => 'from-sky-500 to-cyan-400', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>'],
            ['label' => 'Pantau Pesanan', 'caption' => 'Prioritaskan order yang masih diproses.', 'route' => route('admin.orders.index'), 'theme' => 'from-amber-500 to-orange-400', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007"/>'],
            ['label' => 'Buka Pesan', 'caption' => 'Balas chat pelanggan yang belum dibaca.', 'route' => route('admin.messages.index'), 'theme' => 'from-fuchsia-500 to-rose-400', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.625 9.75h6.75m-6.75 3h4.5m7.125-5.625a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 7.125v9.75A2.25 2.25 0 006 19.125h9.879a2.25 2.25 0 001.591-.659l2.619-2.619a2.25 2.25 0 00.659-1.591V7.125z"/>'],
        ];

        $collectionTone = $dashboardFinance['collectionRate'] >= 70 ? 'Sehat' : ($dashboardFinance['collectionRate'] >= 40 ? 'Perlu dipacu' : 'Perlu perhatian');
    @endphp

    {{-- Welcome Banner --}}
    <section class="relative mb-8 overflow-hidden rounded-[32px] bg-[linear-gradient(135deg,_rgba(15,23,42,0.98)_0%,_rgba(22,78,99,0.94)_48%,_rgba(6,95,70,0.94)_100%)] p-6 sm:p-8 lg:p-9">
        <div class="absolute inset-0 opacity-40" style="background-image: radial-gradient(circle at 20% 20%, rgba(110, 231, 183, 0.28), transparent 30%), radial-gradient(circle at 85% 15%, rgba(125, 211, 252, 0.26), transparent 30%), radial-gradient(circle at 70% 80%, rgba(251, 191, 36, 0.14), transparent 28%);"></div>
        <div class="absolute -right-16 top-8 h-52 w-52 rounded-full border border-white/10 bg-white/5 blur-2xl"></div>
        <div class="absolute bottom-0 left-0 h-28 w-full bg-gradient-to-t from-slate-950/25 to-transparent"></div>

        <div class="relative z-10 grid grid-cols-1 gap-8 xl:grid-cols-[1.2fr_0.8fr] xl:items-end">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full border border-emerald-300/20 bg-emerald-300/10 px-3 py-1.5 text-[11px] font-bold uppercase tracking-[0.28em] text-emerald-200">
                    <span class="h-2 w-2 rounded-full bg-emerald-300"></span>
                    Operasional Hari Ini
                </span>
                <h2 class="mt-5 max-w-3xl text-3xl font-bold tracking-tight text-white sm:text-4xl">{{ auth()->user()->name ?? 'Admin' }}, semua kendali toko ada di panel ini.</h2>
                <p class="mt-4 max-w-2xl text-sm leading-relaxed text-slate-300 sm:text-base">Pantau kesehatan penjualan, percepat follow-up order COD, dan jaga respons pelanggan tetap tajam dari satu tampilan yang ringkas.</p>

                <div class="mt-6 flex flex-wrap items-center gap-3">
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3.5 py-2 text-xs font-semibold text-white/90 ring-1 ring-white/10">Collection rate {{ $dashboardFinance['collectionRate'] }}%</span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3.5 py-2 text-xs font-semibold text-white/90 ring-1 ring-white/10">{{ $stats['pendingOrders'] }} pesanan perlu diproses</span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3.5 py-2 text-xs font-semibold text-white/90 ring-1 ring-white/10">{{ $stats['totalMessages'] }} pesan belum dibaca</span>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-3 sm:grid-cols-3 xl:grid-cols-1">
                @foreach($quickActions as $action)
                    <a href="{{ $action['route'] }}" class="group rounded-[24px] border border-white/10 bg-white/[0.08] p-4 backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:bg-white/[0.12]">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-sm font-semibold text-white">{{ $action['label'] }}</p>
                                <p class="mt-1 text-xs leading-relaxed text-slate-300">{{ $action['caption'] }}</p>
                            </div>
                            <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br {{ $action['theme'] }} text-white shadow-lg shadow-slate-950/20">
                                <svg class="h-[18px] w-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $action['icon'] !!}</svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center gap-2 text-[11px] font-bold uppercase tracking-[0.22em] text-slate-300">
                            Buka panel
                            <svg class="h-3.5 w-3.5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-3 sm:gap-4 mb-7">
        @foreach($cards as $card)
            <div class="group relative overflow-hidden rounded-[22px] border border-slate-200/80 bg-white/95 px-4 py-4 shadow-[0_14px_34px_-28px_rgba(15,23,42,0.45)] transition-all duration-300 hover:-translate-y-0.5 hover:shadow-[0_18px_38px_-24px_rgba(15,23,42,0.35)]">
                <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r {{ $card['line'] }} opacity-90"></div>
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0 flex-1">
                        <p class="text-[10px] font-bold uppercase tracking-[0.22em] text-slate-400">{{ $card['label'] }}</p>
                        <p class="mt-3 text-[2rem] leading-none font-extrabold tracking-tight text-slate-900">{{ $card['value'] }}</p>
                        <p class="mt-2 text-xs text-slate-500 leading-relaxed">{{ $card['caption'] }}</p>
                    </div>
                    <div class="shrink-0 w-9 h-9 rounded-[16px] {{ $card['iconWrap'] }} ring-1 flex items-center justify-center shadow-sm transition-transform duration-300 group-hover:scale-105">
                        <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $card['icon'] !!}</svg>
                    </div>
                </div>
                <div class="mt-4 h-px w-full bg-gradient-to-r from-slate-200 via-slate-100 to-transparent"></div>
                <div class="mt-3 flex items-center justify-between text-[11px] text-slate-400">
                    <span class="font-medium">Overview</span>
                    <span class="tracking-[0.18em] uppercase">Admin</span>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-[1.15fr_0.85fr] gap-6 mb-8">
        <div class="bg-white rounded-[28px] border border-slate-200/70 p-6 shadow-sm shadow-slate-200/40">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-500 text-[11px] font-bold uppercase tracking-[0.24em]">Snapshot Keuangan</span>
                    <h3 class="mt-3 text-xl font-bold text-slate-900">Posisi pemasukan bulan ini</h3>
                    <p class="mt-2 text-sm text-slate-500">Omzet berjalan, kas yang sudah masuk, dan nilai COD yang masih outstanding.</p>
                </div>
                <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-slate-900 text-white text-sm font-semibold hover:bg-slate-800 transition-colors">
                    Buka Laporan
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="rounded-2xl border border-slate-100 bg-slate-50/80 px-4 py-4">
                    <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-slate-400">Omzet Bulan Ini</p>
                    <p class="mt-3 text-2xl font-extrabold text-slate-900">Rp {{ number_format($dashboardFinance['monthlyRevenue'], 0, ',', '.') }}</p>
                    <p class="mt-2 text-sm text-slate-500">{{ $dashboardFinance['monthlyOrders'] }} pesanan aktif di bulan {{ now()->translatedFormat('F') }}</p>
                </div>
                <div class="rounded-2xl border border-emerald-100 bg-emerald-50/80 px-4 py-4">
                    <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-emerald-600">Kas Masuk</p>
                    <p class="mt-3 text-2xl font-extrabold text-slate-900">Rp {{ number_format($dashboardFinance['collectedRevenue'], 0, ',', '.') }}</p>
                    <p class="mt-2 text-sm text-emerald-700">Collection rate {{ $dashboardFinance['collectionRate'] }}%</p>
                </div>
                <div class="rounded-2xl border border-amber-100 bg-amber-50/80 px-4 py-4">
                    <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-amber-600">Outstanding COD</p>
                    <p class="mt-3 text-2xl font-extrabold text-slate-900">Rp {{ number_format($dashboardFinance['outstandingRevenue'], 0, ',', '.') }}</p>
                    <p class="mt-2 text-sm text-amber-700">Belum tercatat sebagai kas masuk</p>
                </div>
            </div>

            <div class="mt-6 rounded-[24px] border border-slate-200 bg-[linear-gradient(135deg,_rgba(248,250,252,0.9),_rgba(255,255,255,0.98))] p-5">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-[0.24em] text-slate-400">Kualitas Arus Kas</p>
                        <h4 class="mt-2 text-lg font-bold text-slate-900">Status cashflow: {{ $collectionTone }}</h4>
                        <p class="mt-2 text-sm text-slate-500">Semakin tinggi rasio kas masuk terhadap omzet bulan berjalan, semakin sehat ritme operasional toko.</p>
                    </div>
                    <div class="min-w-[210px]">
                        <div class="flex items-center justify-between text-xs font-semibold text-slate-500">
                            <span>Collection rate</span>
                            <span>{{ $dashboardFinance['collectionRate'] }}%</span>
                        </div>
                        <div class="mt-3 h-3 overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500" style="width: {{ $dashboardFinance['collectionRate'] }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[28px] border border-slate-200/70 p-6 shadow-sm shadow-slate-200/40">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Perlu Dipantau</h3>
                    <p class="mt-1 text-sm text-slate-500">Prioritas kerja admin untuk beberapa jam ke depan.</p>
                </div>
                <span class="rounded-full bg-slate-100 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.24em] text-slate-500">Focus</span>
            </div>

            <div class="mt-5 space-y-4">
                <div class="rounded-2xl border border-blue-100 bg-blue-50/80 px-4 py-4">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-blue-600">Pesanan Diproses</p>
                            <p class="mt-2 text-3xl font-extrabold text-slate-900">{{ number_format($stats['pendingOrders'], 0, ',', '.') }}</p>
                        </div>
                        <div class="w-11 h-11 rounded-2xl bg-white/75 flex items-center justify-center text-blue-700 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6v6l4 2.5m5-2.5a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <p class="mt-3 text-sm text-blue-700">Butuh follow-up agar kas COD cepat terealisasi.</p>
                </div>
                <div class="rounded-2xl border border-fuchsia-100 bg-fuchsia-50/80 px-4 py-4">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-fuchsia-600">Pesan Belum Dibaca</p>
                            <p class="mt-2 text-3xl font-extrabold text-slate-900">{{ number_format($stats['totalMessages'], 0, ',', '.') }}</p>
                        </div>
                        <div class="w-11 h-11 rounded-2xl bg-white/75 flex items-center justify-center text-fuchsia-700 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.625 9.75h6.75m-6.75 3h4.5m7.125-5.625a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 7.125v9.75A2.25 2.25 0 006 19.125h9.879a2.25 2.25 0 001.591-.659l2.619-2.619a2.25 2.25 0 00.659-1.591V7.125z"/></svg>
                        </div>
                    </div>
                    <p class="mt-3 text-sm text-fuchsia-700">Jaga SLA respons admin tetap cepat.</p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50/80 px-4 py-4">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-slate-500">Mode Operasional</p>
                            <p class="mt-2 text-xl font-extrabold text-slate-900">Stabil, tetapi perlu ritme follow-up</p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white text-slate-700 shadow-sm">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12h18M12 3v18"/></svg>
                        </div>
                    </div>
                    <p class="mt-3 text-sm text-slate-600">Kombinasi order aktif dan chat masuk menandakan traffic sehat. Prioritas terbesar ada pada percepatan konversi COD menjadi kas.</p>
                </div>
            </div>
        </div>
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
