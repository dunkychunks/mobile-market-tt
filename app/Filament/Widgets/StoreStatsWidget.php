<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class StoreStatsWidget extends StatsOverviewWidget
{
    /*
     * Stats are cached for 60 seconds so the dashboard stays snappy.
     * A full page refresh is enough to see near-real-time figures.
     */
    protected function getStats(): array
    {
        $stats = Cache::remember('admin_dashboard_stats', 60, function () {
            return [
                'orders_today' => Order::whereDate('created_at', today())->count(),
                'orders_total' => Order::count(),
                'revenue'      => Order::where('payment_status', 'paid')->sum('total'),
                'customers'    => User::where('role', '!=', 'admin')->count(),
                'products'     => Product::where('status', 'active')->count(),
            ];
        });

        return [
            Stat::make('Orders Today', $stats['orders_today'])
                ->icon('heroicon-o-shopping-bag'),
            Stat::make('Total Orders', $stats['orders_total'])
                ->icon('heroicon-o-archive-box'),
            Stat::make('Total Revenue', '$' . number_format($stats['revenue'], 2))
                ->icon('heroicon-o-currency-dollar'),
            Stat::make('Customers', $stats['customers'])
                ->icon('heroicon-o-users'),
            Stat::make('Active Products', $stats['products'])
                ->icon('heroicon-o-tag'),
        ];
    }
}
