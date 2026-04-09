<x-layouts.app title="Invoice Pesanan">
    @php
        $statusMeta = [
            'PROCESSING' => [
                'label' => 'Diproses',
                'badge' => 'bg-sky-100 text-sky-800 ring-sky-200',
                'panel' => 'border-sky-200 bg-sky-50/90 text-sky-900',
                'note' => 'Pesanan sedang disiapkan. Invoice pembayaran sudah siap diunduh kapan saja.',
            ],
            'SHIPPED' => [
                'label' => 'Dikirim',
                'badge' => 'bg-amber-100 text-amber-800 ring-amber-200',
                'panel' => 'border-amber-200 bg-amber-50/90 text-amber-900',
                'note' => 'Pesanan sedang dalam perjalanan. Siapkan pembayaran COD saat kurir tiba.',
            ],
            'COMPLETED' => [
                'label' => 'Selesai',
                'badge' => 'bg-emerald-100 text-emerald-800 ring-emerald-200',
                'panel' => 'border-emerald-200 bg-emerald-50/90 text-emerald-900',
                'note' => 'Pesanan selesai. Invoice ini tersimpan sebagai arsip pembayaran Anda.',
            ],
        ];

        $currentStatus = $statusMeta[$order->status] ?? [
            'label' => $order->status,
            'badge' => 'bg-slate-100 text-slate-700 ring-slate-200',
            'panel' => 'border-slate-200 bg-slate-50 text-slate-900',
            'note' => 'Status pesanan sedang diperbarui.',
        ];

        $orderNumber = strtoupper(substr((string) $order->id, 0, 8));
        $totalItems = $order->orderItems->sum('quantity');
        $invoiceHistoryData = $invoiceHistory->values()->all();
    @endphp

    <div x-data="invoiceDownloadManager({
            prepareUrl: '{{ route('orders.invoice.prepare', $order) }}',
            csrfToken: '{{ csrf_token() }}',
            history: @js($invoiceHistoryData),
        })"
        class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
        <nav class="mb-6 flex flex-wrap items-center gap-2 text-sm text-slate-500">
            <a href="{{ route('orders.index') }}" class="font-medium transition hover:text-emerald-700">Pesanan Saya</a>
            <span>/</span>
            <span class="text-slate-900">Invoice Pembayaran</span>
        </nav>

        <section class="overflow-hidden rounded-[32px] border border-slate-200 bg-white shadow-[0_24px_60px_-40px_rgba(15,23,42,0.35)]">
            <div class="relative overflow-hidden bg-[linear-gradient(135deg,_rgba(15,23,42,0.98)_0%,_rgba(15,118,110,0.95)_52%,_rgba(13,148,136,0.92)_100%)] px-6 py-7 sm:px-8 sm:py-8">
                <div class="absolute inset-0 opacity-40" style="background-image: radial-gradient(circle at 18% 22%, rgba(255,255,255,0.18), transparent 24%), radial-gradient(circle at 82% 15%, rgba(167,243,208,0.20), transparent 24%), radial-gradient(circle at 70% 82%, rgba(253,224,71,0.16), transparent 20%);"></div>
                <div class="relative grid gap-6 lg:grid-cols-[1.2fr_0.8fr] lg:items-end">
                    <div>
                        <span class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-3 py-1.5 text-[11px] font-bold uppercase tracking-[0.24em] text-emerald-100">
                            <span class="h-2 w-2 rounded-full bg-emerald-300"></span>
                            Invoice Pembayaran
                        </span>
                        <h1 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-[2.4rem]">Tagihan pesanan #{{ $orderNumber }}</h1>
                        <p class="mt-3 max-w-2xl text-sm leading-relaxed text-slate-200 sm:text-base">Tampilan ini dibuat ringkas seperti invoice agar mudah dicek sebelum Anda mengunduh PDF pembayaran.</p>

                        <div class="mt-5 flex flex-wrap gap-2.5 text-xs font-semibold text-white/90">
                            <span class="rounded-full bg-white/10 px-3.5 py-2 ring-1 ring-white/10">{{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                            <span class="rounded-full bg-white/10 px-3.5 py-2 ring-1 ring-white/10">{{ $totalItems }} item</span>
                            <span class="rounded-full bg-white/10 px-3.5 py-2 ring-1 ring-white/10">COD / Bayar di Tempat</span>
                        </div>
                    </div>

                    <div class="rounded-[28px] border border-white/10 bg-white/10 p-5 shadow-[0_20px_40px_-30px_rgba(15,23,42,0.8)] backdrop-blur-sm">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-emerald-100/80">Total Pembayaran</p>
                                <p class="mt-3 text-3xl font-extrabold tracking-tight text-white">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                <p class="mt-2 text-sm text-slate-200">Invoice akan diunduh dan otomatis masuk ke arsip invoice di halaman ini.</p>
                            </div>
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold ring-1 ring-inset {{ $currentStatus['badge'] }}">
                                {{ $currentStatus['label'] }}
                            </span>
                        </div>

                        <button type="button" @click="downloadInvoice()" :disabled="loading" class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-emerald-50 disabled:cursor-not-allowed disabled:bg-white/70 disabled:text-slate-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 16.5v-9m0 9l3.75-3.75M12 16.5l-3.75-3.75M4.5 16.5v1.125A2.625 2.625 0 007.125 20.25h9.75A2.625 2.625 0 0019.5 17.625V16.5"/></svg>
                            <span x-show="!loading">Unduh Invoice PDF</span>
                            <span x-show="loading">Menyiapkan Invoice...</span>
                        </button>

                        <noscript>
                            <a href="{{ route('orders.invoice', $order) }}" download class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-emerald-50">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 16.5v-9m0 9l3.75-3.75M12 16.5l-3.75-3.75M4.5 16.5v1.125A2.625 2.625 0 007.125 20.25h9.75A2.625 2.625 0 0019.5 17.625V16.5"/></svg>
                                Unduh Invoice PDF
                            </a>
                        </noscript>

                        <p x-show="message" x-text="message" :class="messageTone" class="mt-3 text-xs font-medium"></p>
                    </div>
                </div>
            </div>

            <div class="grid gap-6 p-6 sm:p-8 xl:grid-cols-[1.1fr_0.9fr]">
                <section class="rounded-[28px] border border-slate-200 bg-slate-50/70 p-5 sm:p-6">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-slate-400">Ringkasan Tagihan</p>
                            <h2 class="mt-2 text-xl font-bold text-slate-900">Invoice pembayaran yang sederhana dan jelas</h2>
                        </div>
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold ring-1 ring-inset {{ $currentStatus['badge'] }}">
                            {{ $currentStatus['label'] }}
                        </span>
                    </div>

                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl border border-white bg-white p-4 shadow-sm shadow-slate-200/40">
                            <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-slate-400">Nomor Invoice</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">#{{ $orderNumber }}</p>
                            <p class="mt-1 text-sm text-slate-500">ID lengkap: {{ $order->id }}</p>
                        </div>
                        <div class="rounded-2xl border border-white bg-white p-4 shadow-sm shadow-slate-200/40">
                            <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-slate-400">Tanggal Pesanan</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $order->created_at->format('d F Y') }}</p>
                            <p class="mt-1 text-sm text-slate-500">{{ $order->created_at->format('H:i') }} WIB</p>
                        </div>
                        <div class="rounded-2xl border border-white bg-white p-4 shadow-sm shadow-slate-200/40">
                            <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-slate-400">Ditagihkan Kepada</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">{{ $order->user->name }}</p>
                            <p class="mt-1 text-sm text-slate-500">{{ $order->user->email }}</p>
                        </div>
                        <div class="rounded-2xl border border-white bg-white p-4 shadow-sm shadow-slate-200/40">
                            <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-slate-400">Metode Pembayaran</p>
                            <p class="mt-2 text-base font-semibold text-slate-900">COD / Bayar di Tempat</p>
                            <p class="mt-1 text-sm text-slate-500">Pembayaran dilakukan saat pesanan diterima</p>
                        </div>
                    </div>

                    <div class="mt-5 rounded-[24px] border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200/30">
                        <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-slate-400">Alamat Pengiriman</p>
                        <p class="mt-3 whitespace-pre-line text-sm leading-relaxed text-slate-700">{{ $order->shipping_address }}</p>
                    </div>
                </section>

                <aside class="space-y-4">
                    <div class="rounded-[28px] border {{ $currentStatus['panel'] }} p-5 shadow-sm">
                        <p class="text-[11px] font-bold uppercase tracking-[0.22em] opacity-70">Status Pesanan</p>
                        <h3 class="mt-2 text-lg font-bold">{{ $currentStatus['label'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed opacity-90">{{ $currentStatus['note'] }}</p>
                    </div>

                    <div class="rounded-[28px] border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200/30">
                        <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-slate-400">Ringkasan Pembayaran</p>
                        <div class="mt-4 space-y-3">
                            <div class="flex items-center justify-between text-sm text-slate-600">
                                <span>Total item</span>
                                <span class="font-semibold text-slate-900">{{ $totalItems }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm text-slate-600">
                                <span>Subtotal</span>
                                <span class="font-semibold text-slate-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm text-slate-600">
                                <span>Ongkir</span>
                                <span class="font-semibold text-emerald-700">Gratis</span>
                            </div>
                            <div class="h-px bg-slate-200"></div>
                            <div class="flex items-center justify-between text-sm font-bold text-slate-900">
                                <span>Total bayar</span>
                                <span class="text-lg text-emerald-700">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div id="arsip-invoice" class="rounded-[28px] border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200/30">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-slate-400">Arsip Invoice</p>
                                <h3 class="mt-2 text-lg font-bold text-slate-900">File PDF yang sudah dibuat</h3>
                            </div>
                            <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.18em] text-slate-600">
                                <span x-text="history.length"></span>&nbsp;file
                            </span>
                        </div>

                        <template x-if="history.length > 0">
                            <div class="mt-4 space-y-3">
                                <template x-for="file in history" :key="file.file_name">
                                    <div class="flex items-center justify-between gap-3 rounded-2xl border border-slate-100 bg-slate-50/80 px-4 py-3">
                                        <div class="min-w-0 flex-1">
                                            <p class="truncate text-sm font-semibold text-slate-900" x-text="file.file_name"></p>
                                            <p class="mt-1 text-xs text-slate-500">
                                                <span x-text="file.generated_at_label"></span>
                                                <span> · </span>
                                                <span x-text="file.size_label"></span>
                                            </p>
                                        </div>
                                        <a :href="file.download_url" download class="inline-flex shrink-0 items-center gap-1.5 rounded-xl border border-emerald-200 bg-white px-3 py-2 text-xs font-semibold text-emerald-700 transition hover:bg-emerald-50">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 16.5v-9m0 9l3.75-3.75M12 16.5l-3.75-3.75M4.5 16.5v1.125A2.625 2.625 0 007.125 20.25h9.75A2.625 2.625 0 0019.5 17.625V16.5"/></svg>
                                            Unduh lagi
                                        </a>
                                    </div>
                                </template>
                            </div>
                        </template>

                        <template x-if="history.length === 0">
                            <p class="mt-4 text-sm leading-relaxed text-slate-500">Belum ada file invoice tersimpan. Setelah Anda menekan tombol unduh, file PDF akan muncul di arsip ini dan bisa diunduh ulang kapan saja.</p>
                        </template>
                    </div>

                    <div class="rounded-[28px] border border-emerald-200 bg-emerald-50/90 p-5 shadow-sm shadow-emerald-100/60">
                        <div class="flex items-start gap-3">
                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg shadow-emerald-500/20">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-emerald-900">Pembayaran tetap COD</p>
                                <p class="mt-1 text-sm leading-relaxed text-emerald-800">Siapkan pembayaran tunai sebesar <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong> saat pesanan diterima di alamat tujuan.</p>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>

            <div class="px-6 pb-6 sm:px-8 sm:pb-8">
                <section class="overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-sm shadow-slate-200/30">
                    <div class="flex flex-col gap-2 border-b border-slate-200 bg-slate-50/80 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-slate-400">Rincian Item</p>
                            <h2 class="mt-1 text-lg font-bold text-slate-900">Daftar buku dalam invoice</h2>
                        </div>
                        <p class="text-sm text-slate-500">{{ $order->orderItems->count() }} baris item</p>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @foreach($order->orderItems as $item)
                            <div class="grid gap-4 px-5 py-4 sm:grid-cols-[minmax(0,1fr)_140px_110px_160px] sm:items-center">
                                <div class="flex min-w-0 items-center gap-4">
                                    @if($item->book->image_url)
                                        <img src="{{ $item->book->image_url }}" alt="{{ $item->book->title }}" class="h-20 w-14 shrink-0 rounded-xl object-cover shadow-sm shadow-slate-300/50">
                                    @else
                                        <div class="flex h-20 w-14 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-sm font-bold text-slate-500">
                                            {{ strtoupper(substr($item->book->title, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <p class="truncate text-base font-semibold text-slate-900">{{ $item->book->title }}</p>
                                        <p class="mt-1 text-sm text-slate-500">Harga satuan Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                                <div class="sm:text-right">
                                    <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-slate-400 sm:hidden">Harga</p>
                                    <p class="text-sm font-semibold text-slate-700">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>

                                <div class="sm:text-right">
                                    <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-slate-400 sm:hidden">Qty</p>
                                    <p class="text-sm font-semibold text-slate-700">{{ $item->quantity }}</p>
                                </div>

                                <div class="sm:text-right">
                                    <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-slate-400 sm:hidden">Subtotal</p>
                                    <p class="text-base font-bold text-slate-900">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-slate-200 bg-slate-50/80 px-5 py-5">
                        <div class="ml-auto max-w-md space-y-3">
                            <div class="flex items-center justify-between text-sm text-slate-600">
                                <span>Subtotal</span>
                                <span class="font-semibold text-slate-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm text-slate-600">
                                <span>Ongkos kirim</span>
                                <span class="font-semibold text-emerald-700">Gratis</span>
                            </div>
                            <div class="flex items-center justify-between border-t border-slate-200 pt-3 text-base font-bold text-slate-900">
                                <span>Total pembayaran</span>
                                <span class="text-2xl text-emerald-700">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        <iframe x-ref="downloadFrame" class="hidden" title="Invoice download frame"></iframe>
    </div>

    @once
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('invoiceDownloadManager', (config) => ({
                    prepareUrl: config.prepareUrl,
                    csrfToken: config.csrfToken,
                    history: config.history ?? [],
                    loading: false,
                    message: '',
                    messageTone: 'text-slate-500',

                    async downloadInvoice() {
                        if (this.loading) {
                            return;
                        }

                        this.loading = true;
                        this.message = 'Menyiapkan invoice PDF...';
                        this.messageTone = 'text-slate-200';

                        try {
                            const response = await fetch(this.prepareUrl, {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': this.csrfToken,
                                },
                            });

                            const data = await response.json();

                            if (!response.ok) {
                                throw new Error(data.message || 'Invoice gagal disiapkan.');
                            }

                            this.history = data.history ?? [];
                            this.message = data.message || 'Invoice berhasil diunduh.';
                            this.messageTone = 'text-emerald-100';
                            this.$refs.downloadFrame.src = data.download_url + '?download=' + Date.now();
                        } catch (error) {
                            this.message = error.message || 'Terjadi kesalahan saat menyiapkan invoice.';
                            this.messageTone = 'text-rose-200';
                        } finally {
                            this.loading = false;
                        }
                    },
                }));
            });
        </script>
    @endonce
</x-layouts.app>
