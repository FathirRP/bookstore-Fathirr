<x-layouts.app title="Dashboard">
    {{-- ========== HEADER SAMBUTAN ========== --}}
    <section class="bg-stone-900 relative overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute top-10 left-10 w-64 h-64 bg-emerald-500/15 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-80 h-80 bg-emerald-700/10 rounded-full blur-3xl"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-white/15 backdrop-blur-md border border-white/20 flex items-center justify-center text-3xl sm:text-4xl font-bold text-white shadow-xl">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-emerald-400 text-sm font-medium">Selamat datang kembali,</p>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mt-1">{{ $user->name }}</h1>
                    <p class="text-stone-400 text-sm mt-2">Kelola pesanan, jelajahi koleksi buku, dan temukan bacaan favorit Anda.</p>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="w-full h-8 sm:h-12">
                <path d="M0 60V30C360 0 720 10 1080 30C1260 42 1380 50 1440 30V60H0Z" fill="#FAFAF9"/>
            </svg>
        </div>
    </section>

    {{-- ========== STATISTIK USER ========== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-4 relative z-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 border border-gray-100 p-5 sm:p-6 card-hover">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">{{ $totalOrders }}</p>
                        <p class="text-xs sm:text-sm text-gray-500 font-medium">Total Pesanan</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 border border-gray-100 p-5 sm:p-6 card-hover">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">Rp {{ number_format($totalSpent, 0, ',', '.') }}</p>
                        <p class="text-xs sm:text-sm text-gray-500 font-medium">Total Belanja</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 border border-gray-100 p-5 sm:p-6 card-hover">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-100 to-amber-200 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">{{ $cartItemsCount }}</p>
                        <p class="text-xs sm:text-sm text-gray-500 font-medium">Item Keranjang</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 border border-gray-100 p-5 sm:p-6 card-hover">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-orange-100 to-orange-200 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">{{ $pendingOrders }}</p>
                        <p class="text-xs sm:text-sm text-gray-500 font-medium">Pesanan Pending</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== AKSI CEPET ========== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
            <a href="{{ route('books.index') }}" class="group flex items-center gap-3 bg-white rounded-xl border border-gray-200 p-4 hover:border-emerald-300 hover:shadow-lg hover:shadow-emerald-100/50 transition-all duration-300">
                <div class="w-10 h-10 bg-emerald-50 rounded-lg flex items-center justify-center group-hover:bg-emerald-100 transition-colors">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <span class="text-sm font-semibold text-gray-700 group-hover:text-emerald-600 transition-colors">Jelajahi Buku</span>
            </a>
            <a href="{{ route('cart.index') }}" class="group flex items-center gap-3 bg-white rounded-xl border border-gray-200 p-4 hover:border-emerald-300 hover:shadow-lg hover:shadow-emerald-100/50 transition-all duration-300">
                <div class="w-10 h-10 bg-emerald-50 rounded-lg flex items-center justify-center group-hover:bg-emerald-100 transition-colors">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                </div>
                <span class="text-sm font-semibold text-gray-700 group-hover:text-emerald-600 transition-colors">Keranjang</span>
            </a>
            <a href="{{ route('orders.index') }}" class="group flex items-center gap-3 bg-white rounded-xl border border-gray-200 p-4 hover:border-stone-300 hover:shadow-lg hover:shadow-stone-100/50 transition-all duration-300">
                <div class="w-10 h-10 bg-stone-100 rounded-lg flex items-center justify-center group-hover:bg-stone-200 transition-colors">
                    <svg class="w-5 h-5 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <span class="text-sm font-semibold text-gray-700 group-hover:text-stone-600 transition-colors">Pesanan Saya</span>
            </a>
            <a href="{{ route('chat.index') }}" class="group flex items-center gap-3 bg-white rounded-xl border border-gray-200 p-4 hover:border-rose-300 hover:shadow-lg hover:shadow-rose-100/50 transition-all duration-300">
                <div class="w-10 h-10 bg-rose-50 rounded-lg flex items-center justify-center group-hover:bg-rose-100 transition-colors">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                </div>
                <span class="text-sm font-semibold text-gray-700 group-hover:text-rose-600 transition-colors">Hubungi Kami</span>
            </a>
        </div>
    </section>

    {{-- ========== BUKU TERLARIS ========== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4">
            <div>
                <span class="inline-block px-3 py-1 bg-red-100 text-red-700 text-xs font-bold uppercase tracking-wider rounded-full mb-3">Populer</span>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Buku Paling Populer</h2>
                <p class="mt-2 text-gray-500 max-w-md text-sm">Buku-buku yang paling banyak dipesan oleh pembaca kami.</p>
            </div>
            <a href="{{ route('books.index') }}" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 font-semibold rounded-xl transition-all duration-200 group text-sm">
                Lihat Semua
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @if($popularBooks->count())
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3">
                @foreach($popularBooks as $book)
                    <x-book-card :book="$book" />
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-2xl border border-gray-200">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <p class="text-gray-500">Belum ada data penjualan. Jelajahi katalog dan mulai berbelanja!</p>
                <a href="{{ route('books.index') }}" class="inline-flex items-center mt-4 px-6 py-2.5 bg-emerald-700 text-white rounded-xl hover:bg-emerald-800 transition font-semibold text-sm">Jelajahi Katalog</a>
            </div>
        @endif
    </section>

    {{-- ========== KATEGORI PALING LAKU ========== --}}
    <section class="bg-white border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center mb-10">
                <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold uppercase tracking-wider rounded-full mb-3">Kategori</span>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Kategori Populer</h2>
                <p class="mt-2 text-gray-500 max-w-lg mx-auto text-sm">Jelajahi buku berdasarkan kategori favorit pembaca kami.</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-5">
                @foreach($popularCategories as $category)
                    <a href="{{ route('books.index', ['category' => $category->id]) }}" class="group relative bg-gradient-to-br from-gray-50 to-white rounded-2xl p-6 sm:p-8 border border-gray-200 hover:border-emerald-300 hover:shadow-xl hover:shadow-emerald-100/50 transition-all duration-300 text-center card-hover overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 to-stone-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                        <div class="relative">
                            @php
                                $svgIcons = [
                                    'Fiksi' => '<svg class="w-8 h-8 sm:w-10 sm:h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>',
                                    'Non-Fiksi' => '<svg class="w-8 h-8 sm:w-10 sm:h-10 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>',
                                    'Teknologi' => '<svg class="w-8 h-8 sm:w-10 sm:h-10 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>',
                                    'Sains' => '<svg class="w-8 h-8 sm:w-10 sm:h-10 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>',
                                    'Sejarah' => '<svg class="w-8 h-8 sm:w-10 sm:h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                                    'Bisnis' => '<svg class="w-8 h-8 sm:w-10 sm:h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>',
                                    'Pengembangan Diri' => '<svg class="w-8 h-8 sm:w-10 sm:h-10 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>',
                                    'Sastra' => '<svg class="w-8 h-8 sm:w-10 sm:h-10 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>',
                                ];
                                $defaultIcon = '<svg class="w-8 h-8 sm:w-10 sm:h-10 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>';
                                $icon = $svgIcons[$category->name] ?? $defaultIcon;
                            @endphp
                            <span class="inline-block group-hover:scale-110 transition-transform duration-300">{!! $icon !!}</span>
                            <h3 class="mt-3 font-bold text-gray-900 group-hover:text-emerald-700 transition-colors duration-200 text-sm sm:text-base">{{ $category->name }}</h3>
                            <p class="mt-1 text-xs text-gray-400 font-medium">{{ $category->books_count }} buku</p>
                            @if($category->total_sold > 0)
                                <p class="mt-1 text-xs text-emerald-600 font-semibold">{{ $category->total_sold }} terjual</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== PESANAN TERBARU & BUKU BARU ========== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Pesanan terbaru --}}
            <div>
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold uppercase tracking-wider rounded-full mb-2">Riwayat</span>
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Pesanan Terbaru</h2>
                    </div>
                    <a href="{{ route('orders.index') }}" class="text-sm text-emerald-700 hover:text-emerald-800 font-semibold">Lihat Semua &rarr;</a>
                </div>

                @if($recentOrders->count())
                    <div class="space-y-3">
                        @foreach($recentOrders as $order)
                            <a href="{{ route('orders.show', $order) }}" class="block bg-white rounded-xl border border-gray-200 p-4 hover:border-emerald-300 hover:shadow-md transition-all duration-200 group">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-900 truncate">#{{ substr($order->id, 0, 8) }}...</p>
                                        <p class="text-xs text-gray-400 mt-1">{{ $order->created_at->format('d M Y, H:i') }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $order->orderItems->count() }} item</p>
                                    </div>
                                    <div class="text-right ml-4">
                                        <p class="text-sm font-bold text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                        @php
                                            $statusColors = [
                                                'PENDING' => 'bg-yellow-100 text-yellow-700',
                                                'PROCESSING' => 'bg-blue-100 text-blue-700',
                                                'SHIPPED' => 'bg-sky-100 text-sky-700',
                                                'DELIVERED' => 'bg-green-100 text-green-700',
                                                'CANCELLED' => 'bg-red-100 text-red-700',
                                            ];
                                            $color = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700';
                                        @endphp
                                        <span class="inline-block mt-1 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-lg {{ $color }}">{{ $order->status }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10 bg-white rounded-2xl border border-gray-200">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        <p class="text-gray-500 text-sm">Belum ada pesanan.</p>
                        <a href="{{ route('books.index') }}" class="inline-flex items-center mt-3 text-sm text-emerald-700 font-semibold hover:text-emerald-800">Mulai Belanja &rarr;</a>
                    </div>
                @endif
            </div>

            {{-- Buku baru --}}
            <div>
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold uppercase tracking-wider rounded-full mb-2">Terbaru</span>
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Baru Ditambahkan</h2>
                    </div>
                    <a href="{{ route('books.index') }}" class="text-sm text-emerald-700 hover:text-emerald-800 font-semibold">Lihat Semua &rarr;</a>
                </div>

                <div class="space-y-3">
                    @foreach($latestBooks as $book)
                        <a href="{{ route('books.show', $book) }}" class="flex items-center gap-4 bg-white rounded-xl border border-gray-200 p-3 hover:border-emerald-300 hover:shadow-md transition-all duration-200 group">
                            <div class="w-16 h-20 rounded-lg overflow-hidden shrink-0">
                                <img src="{{ $book->image_url }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" loading="lazy">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-gray-900 truncate group-hover:text-emerald-700 transition-colors">{{ $book->title }}</h4>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $book->category->name }}</p>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-sm font-extrabold text-emerald-700">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                                    @if($book->stock > 0)
                                        <span class="text-[10px] text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md font-semibold">Stok: {{ $book->stock }}</span>
                                    @else
                                        <span class="text-[10px] text-red-500 bg-red-50 px-2 py-0.5 rounded-md font-semibold">Habis</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
