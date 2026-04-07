<x-layouts.app title="Katalog Buku">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header sama pencarian --}}
        <div class="mb-10 relative z-20">
            <div class="text-center mb-8">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">Katalog Buku</h1>
                <p class="mt-2 text-gray-500 max-w-xl mx-auto">Temukan buku favorit Anda dari koleksi kami yang beragam.</p>
            </div>

            {{-- Search bar + Kategori dropdown --}}
            <div class="max-w-3xl mx-auto mb-8 flex flex-col sm:flex-row items-stretch sm:items-center gap-3 relative z-20">
                {{-- Search bar --}}
                <form method="GET" action="{{ route('books.index') }}" class="flex-1 group" id="search-form">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 to-teal-500/20 rounded-2xl blur-xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex items-center bg-white border border-gray-200 rounded-2xl shadow-sm group-focus-within:shadow-lg group-focus-within:border-emerald-300 transition-all duration-300">
                            <div class="pl-5 pr-2 text-gray-400 group-focus-within:text-emerald-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul buku..."
                                   class="flex-1 py-3.5 px-2 bg-transparent border-none text-sm text-gray-800 focus:outline-none focus:ring-0 placeholder:text-gray-400">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <div class="flex items-center gap-1 pr-2">
                                @if(request('search') || request('category'))
                                    <a href="{{ route('books.index') }}" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition" title="Reset">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </a>
                                @endif
                                <button type="submit" class="px-5 py-2 bg-emerald-700 text-white rounded-xl hover:bg-emerald-800 active:scale-95 transition-all text-sm font-semibold shadow-sm">
                                    Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                {{-- Kategori dropdown --}}
                <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                    <button type="button" @click="open = !open"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3.5 bg-white border border-gray-200 rounded-2xl shadow-sm text-sm font-medium transition-all duration-200 hover:border-emerald-300 hover:shadow-md whitespace-nowrap"
                            :class="open ? 'border-emerald-400 shadow-md ring-2 ring-emerald-100' : ''">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        @if(request('category'))
                            @php $activeCat = $categories->firstWhere('id', request('category')); @endphp
                            <span class="text-emerald-700 font-semibold">{{ $activeCat?->name ?? 'Kategori' }}</span>
                        @else
                            <span class="text-gray-700">Semua Kategori</span>
                        @endif
                        <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    {{-- Dropdown menu --}}
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                         class="absolute right-0 sm:right-0 mt-2 w-64 bg-white border border-gray-200 rounded-2xl shadow-2xl"
                         style="z-index: 9999;" x-cloak>
                        <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/80 rounded-t-2xl">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Pilih Kategori</p>
                        </div>
                        <div class="py-1.5 max-h-72 overflow-y-auto rounded-b-2xl">
                            <a href="{{ route('books.index', request()->only('search')) }}"
                               class="flex items-center gap-3 px-4 py-2.5 text-sm transition-colors {{ !request('category') ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <span class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ !request('category') ? 'bg-emerald-100 text-emerald-600' : 'bg-gray-100 text-gray-400' }}">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                </span>
                                <span>Semua Kategori</span>
                                @if(!request('category'))
                                    <svg class="w-4 h-4 ml-auto text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                @endif
                            </a>
                            @foreach($categories as $cat)
                                <a href="{{ route('books.index', array_merge(request()->only('search'), ['category' => $cat->id])) }}"
                                   class="flex items-center gap-3 px-4 py-2.5 text-sm transition-colors {{ request('category') == $cat->id ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <span class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request('category') == $cat->id ? 'bg-emerald-100 text-emerald-600' : 'bg-gray-100 text-gray-400' }}">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                    </span>
                                    <span>{{ $cat->name }}</span>
                                    @if(request('category') == $cat->id)
                                        <svg class="w-4 h-4 ml-auto text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Info hasil pencarian --}}
            @if(request('search') || request('category'))
                <div class="mt-5 flex items-center justify-center">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-800 rounded-xl text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>
                            Menampilkan <strong>{{ $books->total() }}</strong> hasil
                            @if(request('search')) untuk "<strong>{{ request('search') }}</strong>" @endif
                            @if(request('category'))
                                @php $activeCat = $categories->firstWhere('id', request('category')); @endphp
                                @if($activeCat) di kategori <strong>{{ $activeCat->name }}</strong> @endif
                            @endif
                        </span>
                    </div>
                </div>
            @endif
        </div>

        {{-- Grid buku --}}
        @if($books->count())
            <div class="relative z-10 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3">
                @foreach($books as $book)
                    <x-book-card :book="$book" />
                @endforeach
            </div>

            <div class="mt-8">{{ $books->links() }}</div>
        @else
            <div class="text-center py-16">
                <svg class="mx-auto w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada buku ditemukan</h3>
                <p class="mt-2 text-gray-600">Coba ubah kata kunci pencarian atau filter kategori.</p>
            </div>
        @endif
    </div>
</x-layouts.app>
