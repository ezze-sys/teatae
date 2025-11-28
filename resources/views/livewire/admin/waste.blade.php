<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Form -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg px-4 py-4 md:col-span-1 h-fit">
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Log Waste</h3>
                
                @if (session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-3" role="alert">
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                @endif

                <form wire:submit.prevent="store">
                    <div class="mb-4">
                        <label for="product_id" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Product:</label>
                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="product_id" wire:model="product_id">
                            <option value="">Select Product</option>
                            @foreach(\App\Models\Product::all() as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->stock }})</option>
                            @endforeach
                        </select>
                        @error('product_id') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="quantity" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Quantity:</label>
                        <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="quantity" wire:model="quantity">
                        @error('quantity') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="reason" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Reason:</label>
                        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="reason" wire:model="reason" placeholder="e.g. Expired, Spilled">
                        @error('reason') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full">Log Waste</button>
                </form>
            </div>

            <!-- List -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg px-4 py-4 md:col-span-2">
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Waste History</h3>
                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="px-4 py-2 text-gray-900 dark:text-gray-200">Date</th>
                            <th class="px-4 py-2 text-gray-900 dark:text-gray-200">Product</th>
                            <th class="px-4 py-2 text-gray-900 dark:text-gray-200">Qty</th>
                            <th class="px-4 py-2 text-gray-900 dark:text-gray-200">Reason</th>
                            <th class="px-4 py-2 text-gray-900 dark:text-gray-200">User</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                        <tr class="border-b dark:border-gray-700">
                            <td class="border px-4 py-2 text-gray-900 dark:text-gray-200">{{ $log->created_at->format('d M Y H:i') }}</td>
                            <td class="border px-4 py-2 text-gray-900 dark:text-gray-200">{{ $log->product->name }}</td>
                            <td class="border px-4 py-2 text-gray-900 dark:text-gray-200">{{ $log->quantity }}</td>
                            <td class="border px-4 py-2 text-gray-900 dark:text-gray-200">{{ $log->reason }}</td>
                            <td class="border px-4 py-2 text-gray-900 dark:text-gray-200">{{ $log->user->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
