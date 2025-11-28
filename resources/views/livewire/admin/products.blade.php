<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New Product</button>

            @if($isOpen)
                @include('livewire.admin.create_product')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="px-4 py-2 w-20 text-gray-900 dark:text-gray-200">No.</th>
                        <th class="px-4 py-2 text-gray-900 dark:text-gray-200">Name</th>
                        <th class="px-4 py-2 text-gray-900 dark:text-gray-200">SKU</th>
                        <th class="px-4 py-2 text-gray-900 dark:text-gray-200">Price</th>
                        <th class="px-4 py-2 text-gray-900 dark:text-gray-200">Stock</th>
                        <th class="px-4 py-2 text-gray-900 dark:text-gray-200">Category</th>
                        <th class="px-4 py-2 text-gray-900 dark:text-gray-200">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="border-b dark:border-gray-700">
                        <td class="border px-4 py-2 text-gray-900 dark:text-gray-200">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2 text-gray-900 dark:text-gray-200">{{ $product->name }}</td>
                        <td class="border px-4 py-2 text-gray-900 dark:text-gray-200">{{ $product->sku }}</td>
                        <td class="border px-4 py-2 text-gray-900 dark:text-gray-200">{{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="border px-4 py-2 text-gray-900 dark:text-gray-200">{{ $product->is_stock_managed ? $product->stock : '-' }}</td>
                        <td class="border px-4 py-2 text-gray-900 dark:text-gray-200">{{ $product->category->name }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $product->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Edit</button>
                            <button wire:click="delete({{ $product->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
