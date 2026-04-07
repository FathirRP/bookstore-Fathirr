<x-layouts.app title="Tentang Kami">
    {{-- Bagian hero --}}
    <section class="relative bg-stone-900 overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute top-10 right-20 w-72 h-72 bg-emerald-500/15 rounded-full blur-3xl animate-blob"></div>
            <div class="absolute bottom-10 left-20 w-64 h-64 bg-emerald-700/10 rounded-full blur-3xl animate-blob delay-300"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 text-center">
            <span class="inline-block px-3 py-1 bg-white/10 backdrop-blur-sm text-white text-xs font-bold uppercase tracking-wider rounded-full mb-4 border border-white/20">Tentang Kami</span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-tight">Mengenal Lebih Dekat<br><span class="bg-gradient-to-r from-yellow-300 to-amber-300 bg-clip-text text-transparent">Pusat Imaji</span></h1>
            <p class="mt-6 text-lg text-stone-300 max-w-2xl mx-auto leading-relaxed">Toko buku daring terpercaya yang berkomitmen menghadirkan akses literasi untuk semua kalangan di Indonesia.</p>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="w-full h-12 sm:h-16"><path d="M0 80V40C360 0 720 20 1080 40C1260 50 1380 30 1440 20V80H0Z" fill="#FAFAF9"/></svg>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
        {{-- Siapa kita --}}
        <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 border border-gray-100 p-8 sm:p-12 mb-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                <div>
                    <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold uppercase tracking-wider rounded-full mb-4">Cerita Kami</span>
                    <h2 class="text-3xl font-bold text-gray-900 mb-5">Siapa Kami?</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Pusat Imaji adalah platform e-commerce khusus buku yang didirikan dengan misi untuk membuat buku berkualitas lebih mudah diakses oleh semua kalangan.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Kami percaya bahwa membaca adalah jendela dunia, dan setiap orang berhak mendapatkan akses ke pengetahuan tanpa batas. Dengan teknologi modern dan koleksi buku yang terus bertambah, kami hadir untuk memenuhi kebutuhan literasi Anda.
                    </p>
                </div>
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="w-64 h-80 bg-gradient-to-br from-emerald-100 to-stone-100 rounded-3xl flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-20 h-20 text-emerald-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                <p class="font-bold text-emerald-700 text-xl">Pusat Imaji</p>
                                <p class="text-emerald-600 text-sm mt-1">Sejak 2025</p>
                            </div>
                        </div>
                        <div class="absolute -top-4 -right-4 w-20 h-20 bg-yellow-100 rounded-2xl rotate-12 flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        </div>
                        <div class="absolute -bottom-4 -left-4 w-20 h-20 bg-emerald-100 rounded-2xl -rotate-12 flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Visi & misi --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 border border-gray-100 p-8 sm:p-10 card-hover">
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Visi Kami</h3>
                <p class="text-gray-600 leading-relaxed">
                    Menjadi platform toko buku daring terdepan yang menghubungkan pembaca dengan koleksi buku terlengkap, menciptakan budaya literasi yang kuat di seluruh Indonesia.
                </p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 border border-gray-100 p-8 sm:p-10 card-hover">
                <div class="w-14 h-14 bg-gradient-to-br from-stone-100 to-stone-200 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Misi Kami</h3>
                <p class="text-gray-600 leading-relaxed">
                    Menyediakan layanan pembelian buku yang mudah, aman, dan terjangkau. Membangun komunitas pembaca yang aktif dan berkolaborasi dengan penerbit untuk menghadirkan buku-buku terbaik.
                </p>
            </div>
        </div>

        {{-- Nilai-nilai kita --}}
        <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 border border-gray-100 p-8 sm:p-12 mb-10">
            <div class="text-center mb-10">
                <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold uppercase tracking-wider rounded-full mb-3">Keunggulan</span>
                <h2 class="text-3xl font-bold text-gray-900">Mengapa Memilih Pusat Imaji?</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                <div class="text-center group">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h4 class="font-bold text-gray-900 text-lg">Koleksi Lengkap</h4>
                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">Ribuan judul buku dari berbagai genre dan penerbit terpercaya.</p>
                </div>
                <div class="text-center group">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h4 class="font-bold text-gray-900 text-lg">Transaksi Aman</h4>
                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">Sistem pembayaran yang aman dan terverifikasi untuk kenyamanan Anda.</p>
                </div>
                <div class="text-center group">
                    <div class="w-16 h-16 bg-gradient-to-br from-amber-100 to-amber-200 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h4 class="font-bold text-gray-900 text-lg">Pengiriman Cepat</h4>
                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">Bekerja sama dengan jasa kurir terpercaya untuk pengiriman tepat waktu.</p>
                </div>
            </div>
        </div>

        {{-- Tombol ajakan --}}
        <div class="bg-stone-900 rounded-2xl p-10 sm:p-14 text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
            <div class="relative">
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">Tertarik Bergabung?</h2>
                <p class="text-stone-300 mb-8 max-w-lg mx-auto">Mulai jelajahi koleksi buku terlengkap dan temukan bacaan favorit Anda sekarang.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('books.index') }}" class="inline-flex items-center justify-center px-8 py-3.5 bg-emerald-600 text-white font-bold rounded-2xl hover:bg-emerald-700 transition-all shadow-lg hover:-translate-y-0.5 duration-300">
                        Jelajahi Katalog
                    </a>
                    <a href="{{ route('chat.index') }}" class="inline-flex items-center justify-center px-8 py-3.5 border-2 border-white/30 text-white font-semibold rounded-2xl hover:bg-white/10 transition-all duration-300">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
