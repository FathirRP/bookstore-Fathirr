<x-layouts.admin title="Buku" header="Manajemen Buku">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <p class="text-sm text-slate-400">Kelola semua koleksi buku di toko</p>
        </div>
        <a href="{{ route('admin.books.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl hover:from-emerald-700 hover:to-emerald-800 transition-all text-sm font-semibold shadow-sm shadow-emerald-500/20 hover:shadow-md hover:shadow-emerald-500/25">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            Tambah Buku
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50/80">
                        <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Buku</th>
                        <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-3.5 text-right text-[11px] font-bold text-slate-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($books as $book)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-14 rounded-lg overflow-hidden bg-slate-100 shadow-sm ring-1 ring-slate-200/50 shrink-0">
                                        <img src="{{ $book->image_url }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800">{{ $book->title }}</p>
                                        <p class="text-xs text-slate-400 mt-0.5">{{ $book->author ?? 'Penulis belum diisi' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 text-[11px] font-semibold rounded-lg bg-slate-100 text-slate-600">{{ $book->category->name }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if($book->stock > 0)
                                    <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        {{ $book->stock }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-red-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>
                                        Habis
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.books.edit', $book) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.books.destroy', $book) }}" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mb-3">
                                        <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                                    </div>
                                    <p class="text-sm font-medium text-slate-400">Belum ada buku</p>
                                    <p class="text-xs text-slate-300 mt-1">Tambahkan buku pertama kamu</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($books->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">{{ $books->links() }}</div>
        @endif
    </div>
</x-layouts.admin>
