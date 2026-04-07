<x-layouts.app title="Keranjang Belanja">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Keranjang Belanja</h1>

        @if($cartItems->count())
            <form method="GET" action="{{ route('orders.checkout') }}" id="checkout-form">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                {{-- Pilih semua --}}
                <div class="px-6 py-3 border-b border-gray-200 bg-gray-50 rounded-t-xl">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" id="select-all" class="w-4 h-4 text-emerald-600 border-stone-300 rounded focus:ring-emerald-500">
                        <span class="text-sm font-medium text-gray-700">Pilih Semua</span>
                    </label>
                </div>

                <div class="divide-y divide-gray-200">
                    @foreach($cartItems as $item)
                        <div class="p-6 flex items-center gap-4" data-price="{{ $item->book->price }}" data-quantity="{{ $item->quantity }}">
                            <input type="checkbox" name="items[]" value="{{ $item->id }}" class="cart-checkbox w-4 h-4 text-emerald-600 border-stone-300 rounded focus:ring-emerald-500 shrink-0">
                            <img src="{{ $item->book->image_url }}" alt="{{ $item->book->title }}" class="w-16 h-20 object-cover rounded">
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">{{ $item->book->title }}</h3>
                                <p class="text-sm text-gray-500">{{ $item->book->category->name }}</p>
                                <p class="mt-1 font-bold text-emerald-700">Rp {{ number_format($item->book->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="flex items-center border border-gray-300 rounded-lg">
                                    <button type="button" class="qty-btn px-2 py-1 text-gray-600 hover:text-gray-800 text-sm" data-action="decrease" data-item-id="{{ $item->id }}" data-update-url="{{ route('cart.update', $item) }}">-</button>
                                    <input type="number" value="{{ $item->quantity }}" min="1" max="{{ $item->book->stock }}" class="w-12 text-center border-x border-gray-300 py-1 text-sm focus:outline-none" data-item-id="{{ $item->id }}" data-update-url="{{ route('cart.update', $item) }}" readonly>
                                    <button type="button" class="qty-btn px-2 py-1 text-gray-600 hover:text-gray-800 text-sm" data-action="increase" data-item-id="{{ $item->id }}" data-update-url="{{ route('cart.update', $item) }}">+</button>
                                </div>
                            </div>
                            <p class="font-bold text-gray-900 w-32 text-right">Rp {{ number_format($item->book->price * $item->quantity, 0, ',', '.') }}</p>
                            <button type="button" class="delete-btn text-red-500 hover:text-red-700" title="Hapus" data-delete-url="{{ route('cart.destroy', $item) }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    @endforeach
                </div>

                {{-- Total sama checkout --}}
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between rounded-b-xl">
                    <div>
                        <p class="text-sm text-gray-600">Total (<span id="selected-count">0</span> item)</p>
                        <p class="text-2xl font-bold text-gray-900">Rp <span id="selected-total">0</span></p>
                    </div>
                    <button type="submit" id="checkout-btn" disabled class="px-6 py-3 bg-emerald-700 text-white rounded-lg hover:bg-emerald-800 transition font-medium disabled:opacity-50 disabled:cursor-not-allowed">Lanjut ke Checkout</button>
                </div>
            </div>
            </form>

            {{-- Form tersembunyi buat update jumlah sama hapus --}}
            <form method="POST" id="qty-form" class="hidden">
                @csrf
                @method('PATCH')
                <input type="hidden" name="quantity" id="qty-value">
            </form>
            <form method="POST" id="delete-form" class="hidden">
                @csrf
                @method('DELETE')
            </form>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const selectAll = document.getElementById('select-all');
                    const checkboxes = document.querySelectorAll('.cart-checkbox');
                    const selectedCount = document.getElementById('selected-count');
                    const selectedTotal = document.getElementById('selected-total');
                    const checkoutBtn = document.getElementById('checkout-btn');

                    function formatNumber(num) {
                        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    }

                    function updateTotal() {
                        let total = 0;
                        let count = 0;
                        checkboxes.forEach(cb => {
                            if (cb.checked) {
                                const row = cb.closest('[data-price]');
                                const price = parseFloat(row.dataset.price);
                                const qty = parseInt(row.dataset.quantity);
                                total += price * qty;
                                count += qty;
                            }
                        });
                        selectedCount.textContent = count;
                        selectedTotal.textContent = formatNumber(total);
                        checkoutBtn.disabled = count === 0;
                    }

                    selectAll.addEventListener('change', function() {
                        checkboxes.forEach(cb => cb.checked = this.checked);
                        updateTotal();
                    });

                    checkboxes.forEach(cb => {
                        cb.addEventListener('change', function() {
                            selectAll.checked = [...checkboxes].every(c => c.checked);
                            selectAll.indeterminate = !selectAll.checked && [...checkboxes].some(c => c.checked);
                            updateTotal();
                        });
                    });

                    // Tombol nambah/kurangin jumlah
                    document.querySelectorAll('.qty-btn').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const input = this.parentElement.querySelector('input[type="number"]');
                            const action = this.dataset.action;
                            let val = parseInt(input.value);
                            if (action === 'increase' && val < parseInt(input.max)) val++;
                            else if (action === 'decrease' && val > 1) val--;
                            else return;

                            const form = document.getElementById('qty-form');
                            form.action = this.dataset.updateUrl;
                            document.getElementById('qty-value').value = val;
                            form.submit();
                        });
                    });

                    // Tombol hapus
                    document.querySelectorAll('.delete-btn').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const form = document.getElementById('delete-form');
                            form.action = this.dataset.deleteUrl;
                            form.submit();
                        });
                    });

                    // Cegah checkout kalo belom ada yang dipilih
                    document.getElementById('checkout-form').addEventListener('submit', function(e) {
                        const checked = document.querySelectorAll('.cart-checkbox:checked');
                        if (checked.length === 0) {
                            e.preventDefault();
                            alert('Pilih minimal satu item untuk checkout.');
                        }
                    });
                });
            </script>
        @else
            <div class="text-center py-16 bg-white rounded-xl shadow-sm border border-gray-200">
                <svg class="mx-auto w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Keranjang Anda kosong</h3>
                <p class="mt-2 text-gray-600">Mulai belanja dan temukan buku favorit Anda!</p>
                <a href="{{ route('books.index') }}" class="mt-4 inline-block px-6 py-2 bg-emerald-700 text-white rounded-lg hover:bg-emerald-800 transition text-sm font-medium">Lihat Katalog</a>
            </div>
        @endif
    </div>
</x-layouts.app>
