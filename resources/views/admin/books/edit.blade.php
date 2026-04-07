<x-layouts.admin title="Edit Buku" header="Edit Buku">
    <div class="max-w-2xl">
        <a href="{{ route('admin.books.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-500 hover:text-slate-700 mb-5 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Daftar Buku
        </a>

        <div class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-base font-bold text-slate-800">Edit Informasi Buku</h3>
                <p class="text-xs text-slate-400 mt-0.5">Perbarui data buku yang sudah ada</p>
            </div>
            <form method="POST" action="{{ route('admin.books.update', $book) }}" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')
                <div class="space-y-5">
                    <x-input label="Judul Buku" name="title" :value="$book->title" required />

                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi</label>
                        <textarea name="description" id="description" rows="4" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition placeholder:text-slate-300">{{ old('description', $book->description) }}</textarea>
                        @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <x-input label="Harga (Rp)" name="price" type="number" :value="$book->price" required />
                        <x-input label="Stok" name="stock" type="number" :value="$book->stock" required />
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori</label>
                        <select name="category_id" id="category_id" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-semibold text-slate-700 mb-1.5">Gambar Sampul</label>
                        @if($book->image_url)
                            <div class="mb-3 inline-block">
                                <img src="{{ $book->image_url }}" alt="{{ $book->title }}" class="w-20 h-28 object-cover rounded-xl ring-2 ring-slate-200/50 shadow-sm">
                            </div>
                        @endif
                        <div class="relative">
                            <input type="file" name="image" id="image" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 file:transition-colors file:cursor-pointer">
                        </div>
                        <p class="text-xs text-slate-400 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                        @error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white text-sm font-semibold rounded-xl hover:from-emerald-700 hover:to-emerald-800 transition-all shadow-sm shadow-emerald-500/20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Perbarui Buku
                        </button>
                        <a href="{{ route('admin.books.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>
