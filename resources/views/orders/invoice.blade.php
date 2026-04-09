<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ strtoupper(substr((string) $order->id, 0, 8)) }}</title>
    <style>
        @page {
            margin: 28px 32px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: DejaVu Sans, sans-serif;
            color: #0f172a;
            font-size: 12px;
            line-height: 1.55;
        }

        .page {
            border: 1px solid #dbe4dc;
            border-radius: 18px;
            overflow: hidden;
        }

        .header {
            background: #0f766e;
            color: #ffffff;
            padding: 28px 30px 24px;
        }

        .header-table,
        .summary-table,
        .totals-table,
        .items-table,
        .meta-table {
            width: 100%;
            border-collapse: collapse;
        }

        .brand-title {
            margin: 0;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.4px;
        }

        .brand-subtitle {
            margin-top: 6px;
            font-size: 12px;
            color: #d1fae5;
        }

        .invoice-title {
            text-align: right;
        }

        .invoice-eyebrow {
            font-size: 10px;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            color: #ccfbf1;
        }

        .invoice-number {
            margin: 6px 0 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .content {
            padding: 26px 30px 30px;
            background: #ffffff;
        }

        .meta-row {
            padding: 0 0 18px;
        }

        .meta-box {
            width: 48.5%;
            vertical-align: top;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 16px 18px;
            background: #f8fafc;
        }

        .meta-spacer {
            width: 3%;
        }

        .label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #64748b;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .value-strong {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 4px;
        }

        .muted {
            color: #475569;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .status-processing {
            background: #e0f2fe;
            color: #075985;
        }

        .status-shipped {
            background: #fef3c7;
            color: #92400e;
        }

        .status-completed {
            background: #dcfce7;
            color: #166534;
        }

        .items-wrap {
            margin-top: 2px;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
        }

        .items-table thead th {
            background: #f8fafc;
            color: #475569;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 12px 14px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        .items-table thead th.align-right,
        .items-table tbody td.align-right {
            text-align: right;
        }

        .items-table tbody td {
            padding: 13px 14px;
            border-bottom: 1px solid #eef2f7;
            vertical-align: top;
        }

        .items-table tbody tr:last-child td {
            border-bottom: none;
        }

        .item-title {
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 3px;
        }

        .item-caption {
            font-size: 11px;
            color: #64748b;
        }

        .summary-row {
            margin-top: 18px;
        }

        .summary-left {
            width: 56%;
            vertical-align: top;
            padding-right: 18px;
        }

        .summary-right {
            width: 44%;
            vertical-align: top;
        }

        .note-box {
            border: 1px solid #bbf7d0;
            background: #f0fdf4;
            border-radius: 14px;
            padding: 16px 18px;
        }

        .note-title {
            margin: 0 0 6px;
            font-size: 13px;
            font-weight: 700;
            color: #166534;
        }

        .note-text {
            margin: 0;
            font-size: 11px;
            color: #166534;
        }

        .totals-card {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 14px 16px;
            background: #f8fafc;
        }

        .totals-table td {
            padding: 6px 0;
            font-size: 12px;
        }

        .totals-table .label-cell {
            color: #475569;
        }

        .totals-table .value-cell {
            text-align: right;
            font-weight: 600;
            color: #0f172a;
        }

        .totals-table .free {
            color: #047857;
        }

        .totals-table .grand td {
            border-top: 1px solid #cbd5e1;
            padding-top: 11px;
            font-size: 15px;
            font-weight: 700;
        }

        .totals-table .grand .value-cell {
            color: #0f766e;
        }

        .footer {
            margin-top: 18px;
            border-top: 1px solid #e2e8f0;
            padding-top: 16px;
            font-size: 10.5px;
            color: #64748b;
        }
    </style>
</head>
<body>
    @php
        $statusClasses = [
            'PROCESSING' => 'status-processing',
            'SHIPPED' => 'status-shipped',
            'COMPLETED' => 'status-completed',
        ];

        $statusLabels = [
            'PROCESSING' => 'Diproses',
            'SHIPPED' => 'Dikirim',
            'COMPLETED' => 'Selesai',
        ];

        $statusClass = $statusClasses[$order->status] ?? 'status-processing';
        $statusLabel = $statusLabels[$order->status] ?? $order->status;
    @endphp

    <div class="page">
        <div class="header">
            <table class="header-table">
                <tr>
                    <td style="width: 58%; vertical-align: top;">
                        <p class="brand-title">Pusat Imaji</p>
                        <p class="brand-subtitle">Invoice pembayaran pesanan pelanggan</p>
                    </td>
                    <td class="invoice-title" style="width: 42%; vertical-align: top;">
                        <div class="invoice-eyebrow">Invoice</div>
                        <p class="invoice-number">#{{ strtoupper(substr((string) $order->id, 0, 8)) }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="content">
            <table class="meta-table meta-row">
                <tr>
                    <td class="meta-box">
                        <div class="label">Ditagihkan Kepada</div>
                        <p class="value-strong">{{ $order->user->name }}</p>
                        <div class="muted">{{ $order->user->email }}</div>
                        <div class="muted" style="margin-top: 8px;">{!! nl2br(e($order->shipping_address)) !!}</div>
                    </td>
                    <td class="meta-spacer"></td>
                    <td class="meta-box">
                        <div class="label">Informasi Pesanan</div>
                        <div class="muted"><strong>Tanggal:</strong> {{ $order->created_at->format('d F Y') }}</div>
                        <div class="muted"><strong>Waktu:</strong> {{ $order->created_at->format('H:i') }} WIB</div>
                        <div class="muted"><strong>Pembayaran:</strong> COD / Bayar di Tempat</div>
                        <div style="margin-top: 10px;">
                            <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                        </div>
                    </td>
                </tr>
            </table>

            <div class="items-wrap">
                <table class="items-table">
                    <thead>
                        <tr>
                            <th style="width: 52px;">No</th>
                            <th>Item</th>
                            <th class="align-right" style="width: 70px;">Qty</th>
                            <th class="align-right" style="width: 130px;">Harga</th>
                            <th class="align-right" style="width: 150px;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $index => $item)
                            <tr>
                                <td class="muted">{{ $index + 1 }}</td>
                                <td>
                                    <div class="item-title">{{ $item->book->title }}</div>
                                    <div class="item-caption">Harga satuan untuk invoice pembayaran</div>
                                </td>
                                <td class="align-right">{{ $item->quantity }}</td>
                                <td class="align-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="align-right" style="font-weight: 700;">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <table class="summary-table summary-row">
                <tr>
                    <td class="summary-left">
                        <div class="note-box">
                            <p class="note-title">Instruksi pembayaran</p>
                            <p class="note-text">Siapkan pembayaran tunai sebesar <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong> saat pesanan diterima. Invoice ini dibuat otomatis dan dapat disimpan sebagai bukti transaksi.</p>
                        </div>
                    </td>
                    <td class="summary-right">
                        <div class="totals-card">
                            <table class="totals-table">
                                <tr>
                                    <td class="label-cell">Subtotal</td>
                                    <td class="value-cell">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td class="label-cell">Ongkos kirim</td>
                                    <td class="value-cell free">Gratis</td>
                                </tr>
                                <tr class="grand">
                                    <td class="label-cell">Total pembayaran</td>
                                    <td class="value-cell">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>

            <div class="footer">
                Terima kasih telah berbelanja di Pusat Imaji. Jika ada kendala pada pesanan atau invoice ini, silakan hubungi customer service kami.
            </div>
        </div>
    </div>
</body>
</html>
