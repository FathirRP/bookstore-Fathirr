<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ Str::limit($order->id, 8, '') }} - Pusat Imaji</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f5f5f4;
            color: #1c1917;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .invoice-wrapper {
            max-width: 800px;
            margin: 2rem auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        /* Header */
        .invoice-header {
            background: linear-gradient(135deg, #064e3b 0%, #047857 100%);
            color: #fff;
            padding: 2rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .invoice-header .brand h1 {
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .invoice-header .brand p {
            font-size: 0.8rem;
            opacity: 0.8;
            margin-top: 2px;
        }

        .invoice-header .invoice-title {
            text-align: right;
        }

        .invoice-header .invoice-title h2 {
            font-size: 1.5rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .invoice-header .invoice-title p {
            font-size: 0.8rem;
            opacity: 0.8;
            margin-top: 4px;
        }

        /* Body */
        .invoice-body {
            padding: 2rem 2.5rem;
        }

        /* Info grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e7e5e4;
        }

        .info-block h3 {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #047857;
            margin-bottom: 0.5rem;
        }

        .info-block p {
            font-size: 0.85rem;
            color: #44403c;
            line-height: 1.6;
        }

        .info-block p strong {
            color: #1c1917;
        }

        /* Status badge */
        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-processing { background: #dbeafe; color: #1e40af; }
        .status-shipped { background: #e0f2fe; color: #0369a1; }
        .status-completed { background: #dcfce7; color: #15803d; }

        /* Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }

        .items-table thead th {
            background: #f5f5f4;
            padding: 0.75rem 1rem;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #78716c;
            text-align: left;
            border-bottom: 2px solid #e7e5e4;
        }

        .items-table thead th:last-child,
        .items-table thead th:nth-child(3),
        .items-table thead th:nth-child(4) {
            text-align: right;
        }

        .items-table tbody td {
            padding: 0.85rem 1rem;
            font-size: 0.85rem;
            border-bottom: 1px solid #f5f5f4;
            vertical-align: middle;
        }

        .items-table tbody td:last-child,
        .items-table tbody td:nth-child(3),
        .items-table tbody td:nth-child(4) {
            text-align: right;
        }

        .items-table tbody tr:last-child td {
            border-bottom: 2px solid #e7e5e4;
        }

        .item-number {
            color: #a8a29e;
            font-size: 0.8rem;
        }

        .item-title {
            font-weight: 600;
            color: #1c1917;
        }

        /* Totals */
        .totals {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 2rem;
        }

        .totals-table {
            width: 280px;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            font-size: 0.85rem;
            color: #57534e;
        }

        .totals-row.total {
            border-top: 2px solid #064e3b;
            margin-top: 0.5rem;
            padding-top: 0.75rem;
            font-size: 1.1rem;
            font-weight: 800;
            color: #064e3b;
        }

        /* Payment info */
        .payment-info {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .payment-info .icon {
            width: 36px;
            height: 36px;
            background: #047857;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .payment-info .icon svg {
            width: 18px;
            height: 18px;
            color: #fff;
        }

        .payment-info .text h4 {
            font-size: 0.8rem;
            font-weight: 700;
            color: #064e3b;
        }

        .payment-info .text p {
            font-size: 0.75rem;
            color: #15803d;
        }

        /* Footer */
        .invoice-footer {
            background: #fafaf9;
            border-top: 1px solid #e7e5e4;
            padding: 1.5rem 2.5rem;
            text-align: center;
        }

        .invoice-footer p {
            font-size: 0.75rem;
            color: #a8a29e;
            line-height: 1.6;
        }

        .invoice-footer p strong {
            color: #78716c;
        }

        /* Print button */
        .print-actions {
            max-width: 800px;
            margin: 0 auto 1.5rem;
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.25rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.15s;
        }

        .btn-print {
            background: #064e3b;
            color: #fff;
        }

        .btn-print:hover {
            background: #047857;
        }

        .btn-back {
            background: #fff;
            color: #57534e;
            border: 1px solid #d6d3d1;
        }

        .btn-back:hover {
            background: #f5f5f4;
        }

        .btn svg {
            width: 16px;
            height: 16px;
        }

        @media print {
            body { background: #fff; }
            .invoice-wrapper { box-shadow: none; margin: 0; border-radius: 0; }
            .print-actions { display: none; }
        }

        @media (max-width: 640px) {
            .invoice-header { flex-direction: column; gap: 1rem; padding: 1.5rem; }
            .invoice-header .invoice-title { text-align: left; }
            .invoice-body { padding: 1.5rem; }
            .info-grid { grid-template-columns: 1fr; gap: 1rem; }
            .totals-table { width: 100%; }
            .invoice-footer { padding: 1.25rem 1.5rem; }
        }
    </style>
</head>
<body>
    {{-- Tombol aksi (tidak tampil saat print) --}}
    <div class="print-actions">
        <a href="{{ route('orders.show', $order) }}" class="btn btn-back">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali
        </a>
        <button onclick="window.print()" class="btn btn-print">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Cetak Invoice
        </button>
    </div>

    <div class="invoice-wrapper">
        {{-- Header --}}
        <div class="invoice-header">
            <div class="brand">
                <h1>📚 Pusat Imaji</h1>
                <p>PUJI — Toko Buku Daring Terpercaya</p>
            </div>
            <div class="invoice-title">
                <h2>Invoice</h2>
                <p>#{{ Str::limit($order->id, 8, '') }}</p>
            </div>
        </div>

        {{-- Body --}}
        <div class="invoice-body">
            {{-- Info pelanggan & pesanan --}}
            <div class="info-grid">
                <div class="info-block">
                    <h3>Ditagihkan Kepada</h3>
                    <p>
                        <strong>{{ $order->user->name }}</strong><br>
                        {{ $order->user->email }}<br>
                        {{ $order->shipping_address }}
                    </p>
                </div>
                <div class="info-block" style="text-align: right;">
                    <h3>Detail Invoice</h3>
                    <p>
                        <strong>Tanggal:</strong> {{ $order->created_at->format('d M Y') }}<br>
                        <strong>Waktu:</strong> {{ $order->created_at->format('H:i') }} WIB<br>
                        <strong>Pembayaran:</strong> COD (Bayar di Tempat)<br>
                        <strong>Status:</strong>
                        @php
                            $statusClass = match($order->status) {
                                'PROCESSING' => 'status-processing',
                                'SHIPPED' => 'status-shipped',
                                'COMPLETED' => 'status-completed',
                                default => '',
                            };
                            $statusLabel = match($order->status) {
                                'PROCESSING' => 'Diproses',
                                'SHIPPED' => 'Dikirim',
                                'COMPLETED' => 'Selesai',
                                default => $order->status,
                            };
                        @endphp
                        <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                    </p>
                </div>
            </div>

            {{-- Tabel item --}}
            <table class="items-table">
                <thead>
                    <tr>
                        <th style="width: 40px;">No</th>
                        <th>Item</th>
                        <th style="width: 80px;">Qty</th>
                        <th style="width: 140px;">Harga Satuan</th>
                        <th style="width: 140px;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $index => $item)
                        <tr>
                            <td class="item-number">{{ $index + 1 }}</td>
                            <td class="item-title">{{ $item->book->title }}</td>
                            <td style="text-align: right;">{{ $item->quantity }}</td>
                            <td style="text-align: right;">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td style="text-align: right; font-weight: 600;">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Total --}}
            <div class="totals">
                <div class="totals-table">
                    <div class="totals-row">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="totals-row">
                        <span>Ongkos Kirim</span>
                        <span style="color: #047857; font-weight: 600;">Gratis</span>
                    </div>
                    <div class="totals-row total">
                        <span>Total</span>
                        <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Info pembayaran --}}
            <div class="payment-info">
                <div class="icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div class="text">
                    <h4>Pembayaran: COD (Cash On Delivery)</h4>
                    <p>Pembayaran dilakukan secara tunai saat pesanan diterima.</p>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="invoice-footer">
            <p>
                <strong>Terima kasih telah berbelanja di Pusat Imaji!</strong><br>
                Invoice ini digenerate secara otomatis. Jika ada pertanyaan, silakan hubungi Customer Service kami.
            </p>
        </div>
    </div>
</body>
</html>
