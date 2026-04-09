<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    /**
     * Menampilkan laporan penjualan dan keuangan dengan filter periode.
     */
    public function index(Request $request)
    {
        $filters = $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
        ], [
            'to_date.after_or_equal' => 'Tanggal akhir harus sama atau setelah tanggal awal.',
        ]);

        $fromDate = ! empty($filters['from_date']) ? Carbon::parse($filters['from_date'])->startOfDay() : null;
        $toDate = ! empty($filters['to_date']) ? Carbon::parse($filters['to_date'])->endOfDay() : null;

        $ordersQuery = Order::query();
        $this->applyDateFilters($ordersQuery, $fromDate, $toDate);

        $orders = (clone $ordersQuery)->get(['id', 'total_amount', 'status', 'created_at']);
        $statusOrderTotals = $orders->groupBy('status');

        $itemsSold = OrderItem::query()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->tap(fn ($query) => $this->applyDateFilters($query, $fromDate, $toDate, 'orders.created_at'))
            ->sum('order_items.quantity');

        $grossRevenue = (int) $orders->sum('total_amount');
        $collectedRevenue = (int) $statusOrderTotals->get('COMPLETED', collect())->sum('total_amount');
        $shippedRevenue = (int) $statusOrderTotals->get('SHIPPED', collect())->sum('total_amount');
        $processingRevenue = (int) $statusOrderTotals->get('PROCESSING', collect())->sum('total_amount');
        $totalOrders = $orders->count();

        $reportSummary = [
            'totalOrders' => $totalOrders,
            'grossRevenue' => $grossRevenue,
            'collectedRevenue' => $collectedRevenue,
            'outstandingRevenue' => $processingRevenue + $shippedRevenue,
            'processingRevenue' => $processingRevenue,
            'shippedRevenue' => $shippedRevenue,
            'itemsSold' => (int) $itemsSold,
            'averageOrderValue' => $totalOrders > 0 ? (int) round($grossRevenue / $totalOrders) : 0,
            'collectionRate' => $grossRevenue > 0 ? (int) round(($collectedRevenue / $grossRevenue) * 100) : 0,
        ];

        $statusMeta = [
            'PROCESSING' => [
                'label' => 'Diproses',
                'description' => 'Pesanan COD yang masih menunggu pengiriman.',
                'badge' => 'bg-blue-50 text-blue-700 border-blue-100',
                'bar' => 'bg-blue-500',
            ],
            'SHIPPED' => [
                'label' => 'Dikirim',
                'description' => 'Pesanan dalam perjalanan menuju pelanggan.',
                'badge' => 'bg-sky-50 text-sky-700 border-sky-100',
                'bar' => 'bg-sky-500',
            ],
            'COMPLETED' => [
                'label' => 'Selesai',
                'description' => 'Pesanan yang sudah diterima dan menjadi kas masuk.',
                'badge' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                'bar' => 'bg-emerald-500',
            ],
        ];

        $statusBreakdown = collect($statusMeta)->map(function (array $meta, string $status) use ($statusOrderTotals, $totalOrders) {
            $statusOrders = $statusOrderTotals->get($status, collect());

            return [
                'label' => $meta['label'],
                'description' => $meta['description'],
                'badge' => $meta['badge'],
                'bar' => $meta['bar'],
                'count' => $statusOrders->count(),
                'amount' => (int) $statusOrders->sum('total_amount'),
                'percentage' => $totalOrders > 0 ? (int) round(($statusOrders->count() / $totalOrders) * 100) : 0,
            ];
        })->values();

        $monthlyTrend = $orders
            ->groupBy(fn ($order) => Carbon::parse($order->created_at)->format('Y-m'))
            ->map(function ($group, string $period) {
                $periodDate = Carbon::createFromFormat('Y-m', $period);

                return [
                    'period' => $period,
                    'label' => $periodDate->translatedFormat('M Y'),
                    'grossRevenue' => (int) $group->sum('total_amount'),
                    'collectedRevenue' => (int) $group->where('status', 'COMPLETED')->sum('total_amount'),
                    'orderCount' => $group->count(),
                ];
            })
            ->sortKeys();

        if ($monthlyTrend->isEmpty()) {
            $monthlyTrend = collect(range(5, 0))->map(function (int $monthsBack) {
                $periodDate = now()->subMonths($monthsBack);

                return [
                    'period' => $periodDate->format('Y-m'),
                    'label' => $periodDate->translatedFormat('M Y'),
                    'grossRevenue' => 0,
                    'collectedRevenue' => 0,
                    'orderCount' => 0,
                ];
            });
        } else {
            $monthlyTrend = $monthlyTrend->slice(-6)->values();
        }

        $maxTrendValue = max(1, (int) $monthlyTrend->max('grossRevenue'));
        $monthlyTrend = $monthlyTrend->map(function (array $item) use ($maxTrendValue) {
            $item['percentage'] = $item['grossRevenue'] > 0
                ? max(8, (int) round(($item['grossRevenue'] / $maxTrendValue) * 100))
                : 0;

            return $item;
        });

        $topBooks = OrderItem::query()
            ->selectRaw('books.id, books.title, books.author, SUM(order_items.quantity) as total_quantity, SUM(order_items.quantity * order_items.price) as total_revenue')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('books', 'books.id', '=', 'order_items.book_id')
            ->tap(fn ($query) => $this->applyDateFilters($query, $fromDate, $toDate, 'orders.created_at'))
            ->groupBy('books.id', 'books.title', 'books.author')
            ->orderByDesc('total_quantity')
            ->orderByDesc('total_revenue')
            ->limit(5)
            ->get();

        $recentOrders = (clone $ordersQuery)
            ->with('user')
            ->latest()
            ->take(8)
            ->get();

        $reportPeriodLabel = $this->resolvePeriodLabel($fromDate, $toDate);

        return view('admin.reports.index', [
            'filters' => [
                'from_date' => $filters['from_date'] ?? '',
                'to_date' => $filters['to_date'] ?? '',
            ],
            'reportSummary' => $reportSummary,
            'statusBreakdown' => $statusBreakdown,
            'monthlyTrend' => $monthlyTrend,
            'topBooks' => $topBooks,
            'recentOrders' => $recentOrders,
            'reportPeriodLabel' => $reportPeriodLabel,
        ]);
    }

    /**
     * Menerapkan filter tanggal ke query laporan.
     */
    private function applyDateFilters($query, ?Carbon $fromDate, ?Carbon $toDate, string $column = 'created_at'): void
    {
        if ($fromDate) {
            $query->where($column, '>=', $fromDate);
        }

        if ($toDate) {
            $query->where($column, '<=', $toDate);
        }
    }

    /**
     * Membuat label periode laporan yang mudah dibaca.
     */
    private function resolvePeriodLabel(?Carbon $fromDate, ?Carbon $toDate): string
    {
        if ($fromDate && $toDate) {
            return $fromDate->translatedFormat('d M Y') . ' - ' . $toDate->translatedFormat('d M Y');
        }

        if ($fromDate) {
            return 'Mulai ' . $fromDate->translatedFormat('d M Y');
        }

        if ($toDate) {
            return 'Sampai ' . $toDate->translatedFormat('d M Y');
        }

        return 'Semua Periode';
    }
}