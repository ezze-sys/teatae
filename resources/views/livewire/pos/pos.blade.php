<div class="flex h-screen bg-brand-cream/20 dark:bg-brand-dark overflow-hidden font-sans" x-data="{ 
    notifications: [],
    addNotification(message, type = 'success') {
        const id = Date.now();
        this.notifications.push({ id, message, type });
        setTimeout(() => {
            this.notifications = this.notifications.filter(n => n.id !== id);
        }, 3000);
    }
}"
@notify.window="addNotification($event.detail.message, $event.detail.type)">

    <!-- Notifications -->
    <div class="fixed top-4 right-4 z-50 space-y-2 pointer-events-none">
        <template x-for="notification in notifications" :key="notification.id">
            <div x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-x-8"
                 x-transition:enter-end="opacity-100 transform translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-x-0"
                 x-transition:leave-end="opacity-0 transform translate-x-8"
                 class="pointer-events-auto flex items-center w-full max-w-xs p-4 rounded-lg shadow-lg border-l-4"
                 :class="{
                    'bg-white dark:bg-gray-800 border-emerald-500 text-emerald-600 dark:text-emerald-400': notification.type === 'success',
                    'bg-white dark:bg-brand-dark border-brand-red text-brand-red dark:text-brand-red': notification.type === 'error',
                    'bg-white dark:bg-gray-800 border-blue-500 text-blue-600 dark:text-blue-400': notification.type === 'info'
                 }">
                <div class="flex-shrink-0">
                    <template x-if="notification.type === 'success'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </template>
                    <template x-if="notification.type === 'error'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </template>
                    <template x-if="notification.type === 'info'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </template>
                </div>
                <div class="ml-3 text-sm font-medium" x-text="notification.message"></div>
            </div>
        </template>
    </div>

    <!-- Product Section -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-8 py-4 flex justify-between items-center shadow-sm z-10">
            <div class="flex items-center space-x-4">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white tracking-tight">Menu Sinar Terang</h1>
            </div>
            <div class="w-1/3 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" wire:model.live="search" placeholder="Search menu items..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border-none bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-brand-red/50 transition-all shadow-inner placeholder-gray-500 dark:placeholder-gray-400">
            </div>
        </div>

        <!-- Categories -->
        <div class="px-8 py-6 overflow-x-auto whitespace-nowrap bg-white dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700/50 backdrop-blur-sm">
            <div class="inline-flex space-x-3">
                <button wire:click="selectCategory(null)" class="px-6 py-2.5 rounded-xl font-semibold text-sm transition-all duration-200 {{ is_null($selectedCategory) ? 'bg-brand-red text-white shadow-lg shadow-brand-red/30 transform scale-105' : 'bg-white dark:bg-gray-700 text-brand-gray dark:text-gray-300 hover:bg-brand-cream/30 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600' }}">
                    All Items
                </button>
                @foreach($categories as $category)
                    <button wire:click="selectCategory({{ $category->id }})" class="px-6 py-2.5 rounded-xl font-semibold text-sm transition-all duration-200 {{ $selectedCategory == $category->id ? 'bg-brand-red text-white shadow-lg shadow-brand-red/30 transform scale-105' : 'bg-white dark:bg-gray-700 text-brand-gray dark:text-gray-300 hover:bg-brand-cream/30 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600' }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Product Grid -->
        <div class="flex-1 overflow-y-auto p-8 custom-scrollbar">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @foreach($products as $product)
                    <div wire:click="addToCart({{ $product->id }})" class="group bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer border border-gray-100 dark:border-gray-700 overflow-hidden relative">
                        <div class="aspect-square overflow-hidden relative bg-gray-100 dark:bg-gray-700">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 text-gray-400 dark:text-gray-500">
                                    <span class="text-4xl font-bold opacity-30">{{ substr($product->name, 0, 1) }}</span>
                                </div>
                            @endif
                            
                            @if($product->is_stock_managed)
                                <div class="absolute top-3 right-3">
                                    <span class="px-2.5 py-1 rounded-lg text-xs font-bold shadow-sm backdrop-blur-md {{ $product->stock < 10 ? 'bg-brand-red/90 text-white' : 'bg-white/90 dark:bg-brand-dark/90 text-gray-800 dark:text-gray-100' }}">
                                        {{ $product->stock }} left
                                    </span>
                                </div>
                            @endif
                            
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
                        </div>
                        
                        <div class="p-4">
                            <h3 class="font-bold text-gray-800 dark:text-white mb-1 truncate text-lg group-hover:text-brand-red transition-colors" title="{{ $product->name }}">{{ $product->name }}</h3>
                            <p class="text-sm text-brand-gray dark:text-gray-400 mb-3 truncate">{{ $product->category->name ?? 'Uncategorized' }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-brand-red font-bold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <div class="w-8 h-8 rounded-full bg-gray-50 dark:bg-gray-700 flex items-center justify-center text-gray-400 group-hover:bg-brand-red group-hover:text-white transition-colors duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Cart Sidebar -->
    <div class="w-96 bg-white dark:bg-gray-800 border-l border-gray-200 dark:border-gray-700 flex flex-col shadow-2xl z-20">
        <!-- Customer Info -->
        <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-brand-cream/10 dark:bg-gray-800/50 backdrop-blur-sm">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-brand-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Customer Details
            </h2>
            
            <div class="relative" x-data="{ open: false, search: '' }">
                <button @click="open = !open" class="w-full bg-white dark:bg-gray-700 text-left px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-red/50 shadow-sm flex justify-between items-center transition-all hover:border-brand-red/30">
                    <span x-text="$wire.selectedCustomerName || 'Select Customer'" class="font-medium truncate mr-2"></span>
                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                
                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute w-full mt-2 bg-white dark:bg-gray-700 border border-gray-100 dark:border-gray-600 rounded-xl shadow-xl z-50 max-h-60 overflow-y-auto custom-scrollbar">
                    <div class="p-2 sticky top-0 bg-white dark:bg-gray-700 border-b border-gray-100 dark:border-gray-600">
                        <input x-model="search" type="text" placeholder="Search..." class="w-full px-3 py-2 rounded-lg bg-brand-cream/20 dark:bg-gray-800 border-none text-sm focus:ring-1 focus:ring-brand-red text-gray-800 dark:text-white placeholder-brand-gray/50 dark:placeholder-gray-400">
                    </div>
                    <div @click="$wire.selectCustomer(null); open = false" class="px-4 py-2.5 hover:bg-brand-cream/30 dark:hover:bg-gray-600 cursor-pointer text-brand-gray dark:text-gray-200 text-sm font-medium transition-colors">Guest Customer</div>
                    @foreach($customers as $customer)
                        <div x-show="search === '' || '{{ strtolower($customer->name) }}'.includes(search.toLowerCase())" 
                             @click="$wire.selectCustomer({{ $customer->id }}, '{{ $customer->name }}'); open = false" 
                             class="px-4 py-2.5 hover:bg-brand-cream/30 dark:hover:bg-gray-600 cursor-pointer text-brand-gray dark:text-gray-200 text-sm flex justify-between items-center transition-colors group">
                            <span class="font-medium">{{ $customer->name }}</span>
                            <span class="text-xs text-gray-400 group-hover:text-brand-red">{{ $customer->points }} pts</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Cart Items -->
        <div class="flex-1 overflow-y-auto p-6 space-y-4 custom-scrollbar bg-brand-cream/10 dark:bg-gray-900/30">
            @if(empty($cart))
                <div class="flex flex-col items-center justify-center h-full text-gray-400">
                    <div class="w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <p class="font-medium">Your cart is empty</p>
                    <p class="text-sm text-gray-400 mt-1">Select items to start an order</p>
                </div>
            @else
                @foreach($cart as $item)
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col gap-3 group hover:border-brand-red/30 transition-colors">
                        <div class="flex justify-between items-start">
                            <div class="flex-1 mr-2">
                                <h4 class="font-bold text-gray-800 dark:text-white text-sm line-clamp-2">{{ $item['name'] }}</h4>
                                <p class="text-xs text-brand-gray mt-0.5">@ Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                            </div>
                            <p class="font-bold text-brand-red text-sm whitespace-nowrap">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                        </div>
                        
                        <div class="flex items-center justify-between bg-brand-cream/20 dark:bg-gray-700/50 rounded-lg p-1">
                            <button wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] - 1 }})" class="w-8 h-8 flex items-center justify-center rounded-md bg-white dark:bg-gray-600 text-brand-gray hover:text-brand-red hover:bg-brand-red/10 dark:hover:bg-gray-500 shadow-sm transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                            </button>
                            <span class="font-bold text-gray-800 dark:text-white text-sm w-8 text-center">{{ $item['quantity'] }}</span>
                            <button wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] + 1 }})" class="w-8 h-8 flex items-center justify-center rounded-md bg-white dark:bg-gray-600 text-brand-gray hover:text-brand-red hover:bg-brand-red/10 dark:hover:bg-gray-500 shadow-sm transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Checkout Section -->
        <div class="p-6 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)] z-30">
            <div class="space-y-3 mb-6">
                <div class="flex justify-between text-brand-gray dark:text-gray-400 text-sm">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-brand-gray dark:text-gray-400 text-sm">
                    <span>Tax (10%)</span>
                    <span>Rp {{ number_format($total * 0.1, 0, ',', '.') }}</span>
                </div>
                <div class="border-t border-dashed border-gray-200 dark:border-gray-700 my-2"></div>
                <div class="flex justify-between text-xl font-bold text-gray-900 dark:text-white">
                    <span>Total</span>
                    <span>Rp {{ number_format($total * 1.1, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 mb-4">
                <button wire:click="$set('payment_method', 'cash')" class="py-2.5 rounded-xl font-bold text-sm border-2 transition-all {{ $payment_method === 'cash' ? 'border-brand-red text-brand-red bg-brand-red/10 dark:bg-brand-red/20' : 'border-gray-200 dark:border-gray-700 text-brand-gray hover:border-gray-300 dark:hover:border-gray-600' }}">
                    <span class="flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Cash
                    </span>
                </button>
                <button wire:click="$set('payment_method', 'qris')" class="py-2.5 rounded-xl font-bold text-sm border-2 transition-all {{ $payment_method === 'qris' ? 'border-brand-red text-brand-red bg-brand-red/10 dark:bg-brand-red/20' : 'border-gray-200 dark:border-gray-700 text-brand-gray hover:border-gray-300 dark:hover:border-gray-600' }}">
                    <span class="flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        QRIS
                    </span>
                </button>
            </div>

            <button wire:click="checkout" class="w-full bg-gradient-to-r from-brand-red to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-red-500/30 transform transition-all hover:scale-[1.02] active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed disabled:shadow-none" {{ empty($cart) ? 'disabled' : '' }}>
                Process Payment
            </button>
        </div>
    </div>
</div>
