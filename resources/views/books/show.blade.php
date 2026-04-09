<x-layouts.app title="{{ $book->title }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Breadcrumb navigasi --}}
        <nav class="mb-6 text-sm text-gray-500 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-emerald-700 transition">Home</a>
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('books.index') }}" class="hover:text-emerald-700 transition">Katalog</a>
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('books.index', ['category' => $book->category_id]) }}" class="hover:text-emerald-700 transition">{{ $book->category->name }}</a>
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-900 truncate max-w-xs">{{ $book->title }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">
            {{-- Kolom kiri: Gambar buku --}}
            <div class="lg:col-span-2">
                <div class="sticky top-24">
                    <div class="aspect-[3/4] rounded-2xl overflow-hidden bg-gray-100 shadow-lg">
                        <img src="{{ $book->image_url }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                    </div>
                    {{-- Thumbnail kecil --}}
                    <div class="mt-4 flex justify-center">
                        <div class="w-16 h-20 rounded-lg overflow-hidden border-2 border-emerald-500 shadow-sm">
                            <img src="{{ $book->image_url }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom kanan: Detail buku --}}
            <div class="lg:col-span-3 space-y-6">
                {{-- Kategori --}}
                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-sm font-medium text-emerald-700 bg-emerald-50 rounded-full">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    {{ $book->category->name }}
                </span>

                {{-- Judul --}}
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 leading-tight">{{ $book->title }}</h1>

                {{-- Harga --}}
                <p class="text-3xl font-extrabold text-emerald-700">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                @if($book->author || $book->publisher || $book->published_year || $book->isbn)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @if($book->author)
                            <div class="rounded-xl border border-gray-200 bg-white px-4 py-3 shadow-sm">
                                <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Penulis</p>
                                <p class="mt-1 text-sm font-semibold text-gray-900">{{ $book->author }}</p>
                            </div>
                        @endif
                        @if($book->publisher)
                            <div class="rounded-xl border border-gray-200 bg-white px-4 py-3 shadow-sm">
                                <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Penerbit</p>
                                <p class="mt-1 text-sm font-semibold text-gray-900">{{ $book->publisher }}</p>
                            </div>
                        @endif
                        @if($book->published_year)
                            <div class="rounded-xl border border-gray-200 bg-white px-4 py-3 shadow-sm">
                                <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Tahun Terbit</p>
                                <p class="mt-1 text-sm font-semibold text-gray-900">{{ $book->published_year }}</p>
                            </div>
                        @endif
                        @if($book->isbn)
                            <div class="rounded-xl border border-gray-200 bg-white px-4 py-3 shadow-sm">
                                <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">ISBN</p>
                                <p class="mt-1 text-sm font-semibold text-gray-900">{{ $book->isbn }}</p>
                            </div>
                        @endif
                    </div>
                @endif

                {{-- Stok --}}
                <div>
                    @if($book->stock > 0)
                        <span class="inline-flex items-center text-sm text-green-600">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            Stok tersedia: {{ $book->stock }} unit
                        </span>
                    @else
                        <span class="inline-flex items-center text-sm text-red-600">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                            Stok habis
                        </span>
                    @endif
                </div>

                {{-- Info pengiriman --}}
                <div class="bg-emerald-50/60 border border-emerald-100 rounded-xl px-5 py-4 flex items-start gap-3">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Gratis Ongkos Kirim</p>
                        <p class="text-xs text-gray-500 mt-0.5">Nikmati pengiriman gratis untuk semua pesanan ke seluruh Indonesia.</p>
                    </div>
                </div>

                {{-- Format buku --}}
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-2">Format Buku</h3>
                    <div class="inline-flex items-center gap-2 px-4 py-2.5 border-2 border-emerald-500 bg-emerald-50/30 rounded-xl text-sm font-medium text-emerald-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        Soft Cover
                    </div>
                </div>

                {{-- Tombol keranjang --}}
                @if($book->stock > 0)
                    <form method="POST" action="{{ route('cart.add', $book) }}" class="flex items-center gap-4 pt-2">
                        @csrf
                        <div class="flex items-center border border-gray-300 rounded-xl overflow-hidden bg-white shadow-sm">
                            <button type="button" onclick="this.nextElementSibling.stepDown(); this.nextElementSibling.dispatchEvent(new Event('change'))" class="px-4 py-3 text-gray-500 hover:text-gray-800 hover:bg-gray-50 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                            </button>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $book->stock }}" class="w-14 text-center border-x border-gray-300 py-3 text-sm font-semibold focus:outline-none">
                            <button type="button" onclick="this.previousElementSibling.stepUp(); this.previousElementSibling.dispatchEvent(new Event('change'))" class="px-4 py-3 text-gray-500 hover:text-gray-800 hover:bg-gray-50 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            </button>
                        </div>
                        <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-emerald-700 text-white rounded-xl hover:bg-emerald-800 active:scale-[0.98] transition-all text-sm font-semibold shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Tambah ke Keranjang
                        </button>
                    </form>
                @endif

                {{-- Deskripsi --}}
                <div class="border-t border-gray-200 pt-6 mt-2">
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Deskripsi</h3>
                    <div class="prose prose-sm text-gray-600 leading-relaxed">
                        <p>{{ $book->description }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Buku yang mirip --}}
        @if($relatedBooks->count())
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Buku Terkait</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3">
                    @foreach($relatedBooks as $related)
                        <x-book-card :book="$related" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
