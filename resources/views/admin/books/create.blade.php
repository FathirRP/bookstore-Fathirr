<x-layouts.admin title="Tambah Buku" header="Tambah Buku Baru">
    <div class="max-w-2xl">
        <a href="{{ route('admin.books.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-500 hover:text-slate-700 mb-5 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Daftar Buku
        </a>

        <div class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-base font-bold text-slate-800">Informasi Buku</h3>
                <p class="text-xs text-slate-400 mt-0.5">Isi data buku baru yang akan ditambahkan</p>
            </div>
            <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="space-y-5">
                    <x-input label="Judul Buku" name="title" required />

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-input label="Penulis" name="author" required />
                        <x-input label="Penerbit" name="publisher" required />
                        <x-input label="Tahun Terbit" name="published_year" type="number" min="1000" max="{{ now()->year + 1 }}" required />
                        <x-input label="ISBN" name="isbn" placeholder="Contoh: 9786020000000" required />
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi</label>
                        <textarea name="description" id="description" rows="4" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition placeholder:text-slate-300" placeholder="Tulis deskripsi buku...">{{ old('description') }}</textarea>
                        @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-input label="Harga (Rp)" name="price" type="number" required />
                        <x-input label="Stok" name="stock" type="number" required />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-1.5">Pilih Kategori</label>
                            <select name="category_id" id="category_id" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="new_category_name" class="block text-sm font-semibold text-slate-700 mb-1.5">Atau Tambah Kategori Baru</label>
                            <input type="text" name="new_category_name" id="new_category_name" value="{{ old('new_category_name') }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition placeholder:text-slate-300" placeholder="Contoh: Psikologi">
                            <p class="mt-1 text-xs text-slate-400">Jika diisi, kategori akan dibuat otomatis dan langsung dipakai untuk buku ini.</p>
                            @error('new_category_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-semibold text-slate-700 mb-1.5">Gambar Sampul</label>
                        <div class="relative">
                            <input type="file" name="image" id="image" accept="image/*" required class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 file:transition-colors file:cursor-pointer">
                        </div>
                        @error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white text-sm font-semibold rounded-xl hover:from-emerald-700 hover:to-emerald-800 transition-all shadow-sm shadow-emerald-500/20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Simpan Buku
                        </button>
                        <a href="{{ route('admin.books.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>
