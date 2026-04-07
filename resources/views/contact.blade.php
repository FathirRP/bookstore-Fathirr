<x-layouts.app title="Hubungi Kami">
    {{-- Bagian hero --}}
    <section class="relative bg-stone-900 overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute top-10 left-20 w-72 h-72 bg-emerald-500/15 rounded-full blur-3xl animate-blob"></div>
            <div class="absolute bottom-10 right-20 w-64 h-64 bg-emerald-700/10 rounded-full blur-3xl animate-blob delay-300"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-24 text-center">
            <span class="inline-block px-3 py-1 bg-white/10 backdrop-blur-sm text-white text-xs font-bold uppercase tracking-wider rounded-full mb-4 border border-white/20">Kontak</span>
            <h1 class="text-4xl sm:text-5xl font-black text-white leading-tight">Hubungi Kami</h1>
            <p class="mt-4 text-lg text-stone-300 max-w-xl mx-auto">Punya pertanyaan atau masukan? Kami siap membantu Anda kapan saja.</p>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="w-full h-12 sm:h-16"><path d="M0 80V40C360 0 720 20 1080 40C1260 50 1380 30 1440 20V80H0Z" fill="#FAFAF9"/></svg>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Form kontak --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 border border-gray-100 p-8 sm:p-10">
                    <div class="mb-8">
                        <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold uppercase tracking-wider rounded-full mb-3">Pesan</span>
                        <h2 class="text-2xl font-bold text-gray-900">Kirim Pesan kepada Kami</h2>
                        <p class="mt-2 text-gray-500 text-sm">Isi formulir di bawah ini dan tim kami akan merespons sesegera mungkin.</p>
                    </div>
                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="space-y-5">
                            <x-input label="Subjek" name="subject" required placeholder="Masukkan subjek pesan..." />

                            <div>
                                <label for="content" class="block text-sm font-semibold text-gray-700 mb-1.5">Isi Pesan</label>
                                <textarea name="content" id="content" rows="6" required placeholder="Tuliskan pesan Anda di sini..." class="w-full px-4 py-3 border border-stone-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm transition-all duration-200 hover:border-gray-400 resize-none">{{ old('content') }}</textarea>
                                @error('content') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <x-btn type="submit" class="w-full sm:w-auto">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                Kirim Pesan
                            </x-btn>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Info kontak --}}
            <div class="space-y-5">
                <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 border border-gray-100 p-6 card-hover">
                    <div class="flex items-center mb-3">
                        <div class="p-2.5 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-xl">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="ml-3 font-bold text-gray-900">Email</h3>
                    </div>
                    <p class="text-sm text-gray-500">Kirim email kapan saja</p>
                    <p class="text-sm font-semibold text-emerald-700 mt-1">info@pusatimaji.com</p>
                </div>
                <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 border border-gray-100 p-6 card-hover">
                    <div class="flex items-center mb-3">
                        <div class="p-2.5 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-xl">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <h3 class="ml-3 font-bold text-gray-900">Telepon</h3>
                    </div>
                    <p class="text-sm text-gray-500">Senin - Jumat, 09:00 - 17:00</p>
                    <p class="text-sm font-semibold text-emerald-600 mt-1">+62 812 3456 7890</p>
                </div>
                <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 border border-gray-100 p-6 card-hover">
                    <div class="flex items-center mb-3">
                        <div class="p-2.5 bg-gradient-to-br from-amber-100 to-amber-200 rounded-xl">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <h3 class="ml-3 font-bold text-gray-900">Alamat</h3>
                    </div>
                    <p class="text-sm text-gray-500">Kunjungi kantor kami</p>
                    <p class="text-sm font-semibold text-amber-600 mt-1">Jl. Buku Raya No. 123, Jakarta Pusat, Indonesia</p>
                </div>

                {{-- Jam buka --}}
                <div class="bg-stone-900 rounded-2xl p-6 text-white">
                    <h3 class="font-bold text-lg mb-4">Jam Operasional</h3>
                    <div class="space-y-2.5 text-sm">
                        <div class="flex justify-between">
                            <span class="text-stone-400">Senin - Jumat</span>
                            <span class="font-semibold">09:00 - 17:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-stone-400">Sabtu</span>
                            <span class="font-semibold">09:00 - 14:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-stone-400">Minggu</span>
                            <span class="font-semibold text-stone-500">Tutup</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
