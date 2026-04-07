{{-- Komponen kartu buku, bisa dipake berulang --}}
@props(['book'])

<a href="{{ route('books.show', $book) }}" class="block bg-white rounded-lg shadow-sm border border-stone-100 overflow-hidden card-hover group hover:shadow-md transition-shadow duration-300">
    <div class="aspect-[5/6] overflow-hidden relative">
        <img src="{{ $book->image_url }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 ease-out" loading="lazy">
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        @if($book->stock <= 0)
            <div class="absolute top-1.5 right-1.5 bg-red-500 text-white text-[9px] font-bold uppercase tracking-wider px-1.5 py-0.5 rounded shadow-lg">Habis</div>
        @endif
    </div>
    <div class="p-2 sm:p-2.5">
        <span class="inline-block text-[9px] text-emerald-700 font-bold uppercase tracking-wider bg-emerald-50 px-1 py-px rounded">{{ $book->category->name }}</span>
        <h3 class="mt-1 font-bold text-stone-900 truncate text-[11px] sm:text-xs group-hover:text-emerald-700 transition-colors duration-200">{{ $book->title }}</h3>
        <p class="mt-0.5 text-[10px] text-stone-400 line-clamp-1 leading-snug">{{ $book->description }}</p>
        <div class="mt-1.5 pt-1.5 border-t border-stone-100 flex items-center justify-between">
            <span class="text-xs sm:text-sm font-extrabold text-emerald-700">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
            @if($book->stock > 0)
                <span class="text-[9px] text-emerald-600 bg-emerald-50 px-1 py-px rounded font-semibold">Stok: {{ $book->stock }}</span>
            @else
                <span class="text-[9px] text-red-500 bg-red-50 px-1 py-px rounded font-semibold">Habis</span>
            @endif
        </div>
    </div>
</a>
