<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $totalSales = \App\Models\Order::where('status', 'completed')->sum('total');
        $totalOrders = \App\Models\Order::count();
        $lowStockProducts = \App\Models\Product::where('is_stock_managed', true)->where('stock', '<', 10)->get();
        $recentOrders = \App\Models\Order::latest()->take(5)->get();
        $lowStockCount = $lowStockProducts->count();

        return view('livewire.admin.dashboard', [
            'totalSales' => $totalSales,
            'totalOrders' => $totalOrders,
            'lowStockProducts' => $lowStockProducts,
            'lowStockCount' => $lowStockCount,
            'recentOrders' => $recentOrders,
        ])->layout('layouts.admin');
    }
}
