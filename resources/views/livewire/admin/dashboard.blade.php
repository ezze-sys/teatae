<div class="py-12 bg-brand-cream/20 dark:bg-brand-dark min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Welcome Section -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">Dashboard</h1>
                <p class="mt-1 text-sm text-brand-gray dark:text-gray-400">Overview of your store's performance.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 shadow-sm border border-gray-200 dark:border-gray-700">
                    <svg class="mr-1.5 h-4 w-4 text-brand-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ now()->format('l, d F Y') }}
                </span>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Sales -->
            <div class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 transition-all duration-300 hover:shadow-md group">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-gradient-to-br from-brand-red/20 to-brand-red/10 dark:from-brand-red/20 dark:to-brand-red/10 rounded-full opacity-50 blur-xl group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-brand-gray dark:text-gray-400">Total Sales</p>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">Rp {{ number_format($totalSales, 0, ',', '.') }}</h3>
                    </div>
                    <div class="p-3 bg-brand-red/10 dark:bg-brand-red/20 rounded-xl text-brand-red dark:text-brand-red">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-brand-red dark:text-brand-red font-medium flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        +12.5%
                    </span>
                    <span class="text-gray-400 ml-2">from last month</span>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 transition-all duration-300 hover:shadow-md group">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-gradient-to-br from-brand-gray/20 to-brand-gray/10 dark:from-brand-gray/20 dark:to-brand-gray/10 rounded-full opacity-50 blur-xl group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-brand-gray dark:text-gray-400">Total Orders</p>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ number_format($totalOrders) }}</h3>
                    </div>
                    <div class="p-3 bg-brand-gray/10 dark:bg-brand-gray/20 rounded-xl text-brand-gray dark:text-brand-cream">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-brand-gray dark:text-brand-cream font-medium flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        +8.2%
                    </span>
                    <span class="text-gray-400 ml-2">from last month</span>
                </div>
            </div>

            <!-- Low Stock -->
            <div class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 transition-all duration-300 hover:shadow-md group">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-gradient-to-br from-brand-red/20 to-brand-red/10 dark:from-brand-red/20 dark:to-brand-red/10 rounded-full opacity-50 blur-xl group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-brand-gray dark:text-gray-400">Low Stock Items</p>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $lowStockCount }}</h3>
                    </div>
                    <div class="p-3 bg-brand-red/10 dark:bg-brand-red/20 rounded-xl text-brand-red dark:text-brand-red">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    @if($lowStockCount > 0)
                        <span class="text-brand-red dark:text-brand-red font-medium">Action Needed</span>
                        <span class="text-gray-400 ml-2">Restock soon</span>
                    @else
                        <span class="text-brand-red dark:text-brand-red font-medium">Healthy</span>
                        <span class="text-gray-400 ml-2">Stock levels good</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Orders -->
            <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Recent Orders</h3>
                    <a href="#" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">View all</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700">
                        <thead class="bg-brand-cream/30 dark:bg-gray-900/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Invoice</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 bg-white dark:bg-gray-800">
                            @foreach($recentOrders as $order)
                                <tr class="hover:bg-brand-cream/10 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">#{{ $order->invoice_number }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900 dark:text-gray-200 font-medium">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClasses = [
                                                'completed' => 'bg-brand-gray/10 text-brand-gray dark:bg-brand-gray/20 dark:text-brand-cream',
                                                'pending' => 'bg-brand-red/10 text-brand-red dark:bg-brand-red/20 dark:text-brand-red',
                                                'cancelled' => 'bg-brand-dark/10 text-brand-dark dark:bg-brand-dark/20 dark:text-brand-cream',
                                            ];
                                            $statusClass = $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                                        @endphp
                                        <span class="px-2.5 py-0.5 inline-flex text-xs font-medium rounded-full {{ $statusClass }}">
                                            {{ ucfirst($order->status ?? 'Completed') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $order->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Low Stock Alert List -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center">
                        <span class="relative flex h-3 w-3 mr-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-red opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3 w-3 bg-brand-red"></span>
                        </span>
                        Low Stock Alerts
                    </h3>
                </div>
                <div class="flex-1 overflow-y-auto p-0 max-h-[400px]">
                    @if($lowStockProducts->isEmpty())
                        <div class="flex flex-col items-center justify-center h-full p-8 text-center">
                            <div class="p-3 bg-brand-gray/10 dark:bg-brand-gray/20 rounded-full text-brand-gray mb-3">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 font-medium">All stocked up!</p>
                            <p class="text-xs text-gray-400 mt-1">No items are currently low on stock.</p>
                        </div>
                    @else
                        <ul class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($lowStockProducts as $product)
                                <li class="p-4 hover:bg-brand-cream/10 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->name }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">SKU: {{ $product->sku ?? 'N/A' }}</p>
                                        </div>
                                        <span class="px-2.5 py-0.5 inline-flex text-xs font-bold rounded-full bg-brand-red/10 text-brand-red dark:bg-brand-red/20 dark:text-brand-red border border-brand-red/20 dark:border-brand-red/30">
                                            {{ $product->stock }} left
                                        </span>
                                    </div>
                                    <div class="mt-2 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                                        <div class="bg-brand-red h-1.5 rounded-full" style="width: {{ min(($product->stock / 10) * 100, 100) }}%"></div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                @if(!$lowStockProducts->isEmpty())
                    <div class="p-4 bg-brand-cream/30 dark:bg-gray-900/50 border-t border-gray-100 dark:border-gray-700 text-center">
                        <a href="#" class="text-xs font-medium text-rose-600 dark:text-rose-400 hover:text-rose-500">Manage Inventory &rarr;</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
