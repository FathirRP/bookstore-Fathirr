<x-layouts.app title="Beranda">
    {{-- ========== BAGIAN HERO ========== --}}
    <section class="relative bg-stone-900 overflow-hidden min-h-[85vh] flex items-center">
        {{-- Background tipis --}}
        <div class="absolute inset-0 opacity-[0.03]">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="dots" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="2" cy="2" r="1" fill="white"/></pattern></defs><rect width="100%" height="100%" fill="url(#dots)"/></svg>
        </div>
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-emerald-900/30 rounded-full blur-[128px]"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-emerald-800/20 rounded-full blur-[100px]"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                {{-- Konten kiri --}}
                <div class="animate-slide-in-left">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-emerald-900/50 text-emerald-300 text-sm font-medium rounded-full mb-8 border border-emerald-700/30">
                        <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span>
                        Toko Buku Daring #1 di Indonesia
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-extrabold text-white leading-[1.1] tracking-tight">
                        Temukan Dunia
                        <span class="text-emerald-400">Baru</span>
                        di Setiap Halaman
                    </h1>
                    <p class="mt-6 text-lg sm:text-xl text-stone-400 leading-relaxed max-w-lg">
                        Jelajahi ribuan koleksi buku pilihan dari berbagai genre. Dari fiksi hingga pengembangan diri — semuanya ada di sini.
                    </p>
                    <div class="mt-10 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('books.index') }}" class="group inline-flex items-center justify-center px-8 py-4 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700 transition-all duration-300 shadow-lg shadow-emerald-900/30">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            Jelajahi Katalog
                        </a>
                        <a href="{{ route('about') }}" class="group inline-flex items-center justify-center px-8 py-4 border border-stone-600 text-stone-300 font-semibold rounded-xl hover:bg-stone-800 hover:border-stone-500 transition-all duration-300">
                            Tentang Kami
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                    {{-- Statistik singkat --}}
                    <div class="mt-14 flex items-center gap-8 sm:gap-12">
                        <div>
                            <p class="text-3xl font-extrabold text-white">{{ $stats['totalBooks'] }}+</p>
                            <p class="text-sm text-stone-500 mt-0.5">Koleksi Buku</p>
                        </div>
                        <div class="w-px h-10 bg-stone-700"></div>
                        <div>
                            <p class="text-3xl font-extrabold text-white">{{ $stats['totalCategories'] }}</p>
                            <p class="text-sm text-stone-500 mt-0.5">Kategori</p>
                        </div>
                        <div class="w-px h-10 bg-stone-700"></div>
                        <div>
                            <p class="text-3xl font-extrabold text-white">{{ $stats['totalUsers'] }}+</p>
                            <p class="text-sm text-stone-500 mt-0.5">Pembaca</p>
                        </div>
                    </div>
                </div>

                {{-- Visual kanan --}}
                <div class="hidden lg:flex justify-center animate-slide-in-right">
                    <div class="relative">
                        <div class="absolute -top-6 -left-6 w-40 h-56 bg-emerald-900/40 backdrop-blur rounded-2xl rotate-[-10deg] border border-emerald-800/30 animate-float flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-10 h-10 text-emerald-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                <p class="text-emerald-300/80 text-xs mt-2 font-medium">Fiksi</p>
                            </div>
                        </div>
                        <div class="absolute -bottom-4 -right-8 w-40 h-56 bg-stone-800/60 backdrop-blur rounded-2xl rotate-[8deg] border border-stone-700/40 animate-float-reverse flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-10 h-10 text-stone-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                                <p class="text-stone-400 text-xs mt-2 font-medium">Non-Fiksi</p>
                            </div>
                        </div>
                        <div class="relative w-64 h-auto bg-stone-800/80 backdrop-blur-lg rounded-3xl border border-stone-700/50 flex flex-col items-center justify-center shadow-2xl p-8">
                            <div class="w-16 h-16 bg-emerald-700 rounded-2xl flex items-center justify-center mb-4">
                                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M3 5.5C3 4.12 4.12 3 5.5 3h13C19.88 3 21 4.12 21 5.5v2C21 8.88 19.88 10 18.5 10h-13C4.12 10 3 8.88 3 7.5v-2zM3 16.5c0-1.38 1.12-2.5 2.5-2.5h13c1.38 0 2.5 1.12 2.5 2.5v2c0 1.38-1.12 2.5-2.5 2.5h-13C4.12 21 3 19.88 3 18.5v-2z"/></svg>
                            </div>
                            <h2 class="text-white font-bold text-xl">PUJI</h2>
                            <p class="text-stone-500 text-sm mt-1">Pusat Imaji</p>
                            <div class="mt-6 w-full space-y-2">
                                <div class="flex items-center gap-3 px-4 py-3 bg-stone-900/60 rounded-xl">
                                    <div class="w-8 h-8 bg-emerald-800/60 rounded-lg flex items-center justify-center"><svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg></div>
                                    <div><p class="text-white text-sm font-semibold">{{ $stats['totalBooks'] }} Buku</p><p class="text-stone-500 text-[10px]">Tersedia</p></div>
                                </div>
                                <div class="flex items-center gap-3 px-4 py-3 bg-stone-900/60 rounded-xl">
                                    <div class="w-8 h-8 bg-emerald-800/60 rounded-lg flex items-center justify-center"><svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg></div>
                                    <div><p class="text-white text-sm font-semibold">{{ $stats['totalCategories'] }} Genre</p><p class="text-stone-500 text-[10px]">Kategori</p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== BUKU TERBARU ========== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
            <div>
                <span class="inline-block px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold uppercase tracking-wider rounded-full mb-3">Terbaru</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-stone-900">Buku Terbaru Kami</h2>
                <p class="mt-2 text-stone-500 max-w-md">Koleksi terbaru yang baru saja ditambahkan, siap untuk Anda jelajahi.</p>
            </div>
            <a href="{{ route('books.index') }}" class="hidden sm:inline-flex items-center gap-2 px-6 py-3 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 font-semibold rounded-xl transition-all group">
                Lihat Semua
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @if($latestBooks->count())
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3">
                @foreach($latestBooks as $book)
                    <x-book-card :book="$book" />
                @endforeach
            </div>
            <div class="mt-10 text-center sm:hidden">
                <a href="{{ route('books.index') }}" class="inline-flex items-center px-8 py-3.5 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-all font-semibold shadow-lg">
                    Lihat Semua Buku &rarr;
                </a>
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-2xl border border-stone-200">
                <span class="text-5xl mb-4 block">📭</span>
                <p class="text-stone-500 text-lg">Belum ada buku yang tersedia.</p>
                <p class="text-stone-400 text-sm mt-1">Nantikan koleksi terbaru kami!</p>
            </div>
        @endif
    </section>

    {{-- ========== KATEGORI ========== --}}
    <section class="bg-white border-y border-stone-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center mb-12">
                <span class="inline-block px-3 py-1 bg-stone-100 text-stone-600 text-xs font-bold uppercase tracking-wider rounded-full mb-3">Kategori</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-stone-900">Jelajahi Berdasarkan Genre</h2>
                <p class="mt-3 text-stone-500 max-w-lg mx-auto">Temukan buku sesuai minat dan genre favorit Anda.</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-5">
                @foreach($categories as $category)
                    <a href="{{ route('books.index', ['category' => $category->id]) }}" class="group relative bg-white rounded-2xl p-6 sm:p-8 border border-stone-200 hover:border-emerald-300 hover:shadow-lg transition-all duration-300 text-center overflow-hidden">
                        <div class="absolute inset-0 bg-emerald-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
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
                            <h3 class="mt-3 font-bold text-stone-900 group-hover:text-emerald-700 transition-colors">{{ $category->name }}</h3>
                            <p class="mt-1 text-sm text-stone-400 font-medium">{{ $category->books_count }} buku</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== KENAPA PILIH KITA ========== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-14">
            <span class="inline-block px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold uppercase tracking-wider rounded-full mb-3">Keunggulan</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-stone-900">Mengapa Memilih Pusat Imaji?</h2>
            <p class="mt-3 text-stone-500 max-w-lg mx-auto">Kami memberikan pengalaman belanja buku terbaik untuk Anda.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
            <div class="text-center group p-6 rounded-2xl hover:bg-white hover:shadow-lg transition-all duration-300">
                <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:bg-emerald-100 group-hover:scale-110 transition-all duration-300">
                    <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="font-bold text-stone-900 text-lg">Pencarian Mudah</h3>
                <p class="mt-2 text-sm text-stone-500 leading-relaxed">Cari buku berdasarkan judul atau filter berdasarkan kategori dengan cepat.</p>
            </div>
            <div class="text-center group p-6 rounded-2xl hover:bg-white hover:shadow-lg transition-all duration-300">
                <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:bg-amber-100 group-hover:scale-110 transition-all duration-300">
                    <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="font-bold text-stone-900 text-lg">Transaksi Aman</h3>
                <p class="mt-2 text-sm text-stone-500 leading-relaxed">Sistem pembayaran terverifikasi dengan proteksi data yang terjamin.</p>
            </div>
            <div class="text-center group p-6 rounded-2xl hover:bg-white hover:shadow-lg transition-all duration-300">
                <div class="w-14 h-14 bg-sky-50 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:bg-sky-100 group-hover:scale-110 transition-all duration-300">
                    <svg class="w-7 h-7 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="font-bold text-stone-900 text-lg">Pengiriman Cepat</h3>
                <p class="mt-2 text-sm text-stone-500 leading-relaxed">Bekerja sama dengan kurir terpercaya untuk pengiriman tepat waktu.</p>
            </div>
            <div class="text-center group p-6 rounded-2xl hover:bg-white hover:shadow-lg transition-all duration-300">
                <div class="w-14 h-14 bg-rose-50 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:bg-rose-100 group-hover:scale-110 transition-all duration-300">
                    <svg class="w-7 h-7 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h3 class="font-bold text-stone-900 text-lg">Layanan 24/7</h3>
                <p class="mt-2 text-sm text-stone-500 leading-relaxed">Tim kami siap membantu Anda kapan saja melalui fitur chat.</p>
            </div>
        </div>
    </section>

    {{-- ========== GIMANA CARA BELANJA ========== --}}
    <section class="bg-stone-100/50 border-y border-stone-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center mb-14">
                <span class="inline-block px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold uppercase tracking-wider rounded-full mb-3">Panduan</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-stone-900">Cara Berbelanja</h2>
                <p class="mt-3 text-stone-500 max-w-md mx-auto">Empat langkah mudah untuk mendapatkan buku impian Anda.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 relative">
                <div class="hidden lg:block absolute top-7 left-[12%] right-[12%] h-px bg-stone-300 border-dashed"></div>

                <div class="relative text-center group">
                    <div class="w-14 h-14 bg-emerald-700 text-white rounded-2xl flex items-center justify-center mx-auto text-xl font-bold mb-5 group-hover:scale-110 transition-transform duration-300 relative z-10">1</div>
                    <h3 class="font-bold text-stone-900 text-lg">Pilih Buku</h3>
                    <p class="mt-2 text-sm text-stone-500 max-w-[200px] mx-auto">Jelajahi katalog dan temukan buku yang Anda sukai.</p>
                </div>
                <div class="relative text-center group">
                    <div class="w-14 h-14 bg-emerald-600 text-white rounded-2xl flex items-center justify-center mx-auto text-xl font-bold mb-5 group-hover:scale-110 transition-transform duration-300 relative z-10">2</div>
                    <h3 class="font-bold text-stone-900 text-lg">Masukkan Keranjang</h3>
                    <p class="mt-2 text-sm text-stone-500 max-w-[200px] mx-auto">Tambahkan buku ke keranjang dan atur jumlah pesanan.</p>
                </div>
                <div class="relative text-center group">
                    <div class="w-14 h-14 bg-emerald-500 text-white rounded-2xl flex items-center justify-center mx-auto text-xl font-bold mb-5 group-hover:scale-110 transition-transform duration-300 relative z-10">3</div>
                    <h3 class="font-bold text-stone-900 text-lg">Checkout</h3>
                    <p class="mt-2 text-sm text-stone-500 max-w-[200px] mx-auto">Isi alamat pengiriman dan konfirmasi pesanan Anda.</p>
                </div>
                <div class="relative text-center group">
                    <div class="w-14 h-14 bg-amber-500 text-white rounded-2xl flex items-center justify-center mx-auto text-xl font-bold mb-5 group-hover:scale-110 transition-transform duration-300 relative z-10">4</div>
                    <h3 class="font-bold text-stone-900 text-lg">Terima Buku</h3>
                    <p class="mt-2 text-sm text-stone-500 max-w-[200px] mx-auto">Bayar saat buku sampai (COD) di alamat Anda.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== TESTIMONI ========== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-14">
            <span class="inline-block px-3 py-1 bg-amber-50 text-amber-700 text-xs font-bold uppercase tracking-wider rounded-full mb-3">Testimoni</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-stone-900">Apa Kata Pembaca Kami?</h2>
            <p class="mt-3 text-stone-500 max-w-md mx-auto">Cerita dari para pembaca yang sudah menjadi bagian dari komunitas Pusat Imaji.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-8 border border-stone-100 shadow-sm card-hover">
                <div class="flex items-center gap-1 text-amber-400 mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <p class="text-stone-600 leading-relaxed text-sm">"Koleksi bukunya sangat lengkap dan proses pemesanannya mudah sekali. Pengiriman juga cepat. Sangat merekomendasikan!"</p>
                <div class="mt-6 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-emerald-700 flex items-center justify-center text-white font-bold text-xs">A</div>
                    <div>
                        <p class="font-semibold text-stone-900 text-sm">Anisa Rahma</p>
                        <p class="text-stone-400 text-xs">Pembaca Setia</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-8 border border-stone-100 shadow-sm card-hover">
                <div class="flex items-center gap-1 text-amber-400 mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <p class="text-stone-600 leading-relaxed text-sm">"Harga buku-bukunya sangat terjangkau dan kualitasnya bagus. Layanan pelanggannya juga ramah dan responsif."</p>
                <div class="mt-6 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-stone-700 flex items-center justify-center text-white font-bold text-xs">B</div>
                    <div>
                        <p class="font-semibold text-stone-900 text-sm">Budi Santoso</p>
                        <p class="text-stone-400 text-xs">Kolektor Buku</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-8 border border-stone-100 shadow-sm card-hover">
                <div class="flex items-center gap-1 text-amber-400 mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <p class="text-stone-600 leading-relaxed text-sm">"Fitur pencarian dan kategorinya memudahkan mencari buku. Tampilan websitenya modern dan nyaman digunakan."</p>
                <div class="mt-6 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-amber-600 flex items-center justify-center text-white font-bold text-xs">C</div>
                    <div>
                        <p class="font-semibold text-stone-900 text-sm">Citra Dewi</p>
                        <p class="text-stone-400 text-xs">Mahasiswa</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== AJAKAN GABUNG ========== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 pb-20">
        <div class="relative bg-stone-900 rounded-3xl p-10 sm:p-16 text-center overflow-hidden">
            <div class="absolute top-0 right-0 w-72 h-72 bg-emerald-900/40 rounded-full blur-[80px]"></div>
            <div class="absolute bottom-0 left-0 w-56 h-56 bg-emerald-800/30 rounded-full blur-[60px]"></div>

            <div class="relative">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight">
                    Siap Menemukan Buku<br class="hidden sm:block"> Selanjutnya?
                </h2>
                <p class="mt-5 text-lg text-stone-400 max-w-2xl mx-auto leading-relaxed">
                    Bergabunglah dengan komunitas pembaca kami. Daftar sekarang dan mulai jelajahi ribuan koleksi buku berkualitas.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-10 py-4 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700 transition-all shadow-lg text-lg">
                            Daftar Gratis Sekarang
                        </a>
                    @endguest
                    <a href="{{ route('books.index') }}" class="inline-flex items-center justify-center px-10 py-4 border border-stone-600 text-stone-300 font-semibold rounded-xl hover:bg-stone-800 transition-all text-lg">
                        Lihat Katalog Buku
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
