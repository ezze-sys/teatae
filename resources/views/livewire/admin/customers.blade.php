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

            <button wire:click="create()" class="bg-brand-gray hover:bg-brand-gray/80 text-white font-bold py-2 px-4 rounded my-3">Create New Customer</button>

            @if($isOpen)
                @include('livewire.admin.create_customer')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="px-4 py-2 w-20 text-gray-900 dark:text-gray-200">No.</th>
                        <th class="px-4 py-2 text-gray-900 dark:text-gray-200">Name</th>
                        <th class="px-4 py-2 text-gray-900 dark:text-gray-200">Phone</th>
                        <th class="px-4 py-2 text-gray-900 dark:text-gray-200">Points</th>
                        <th class="px-4 py-2 text-gray-900 dark:text-gray-200">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    <tr class="border-b dark:border-gray-700">
                        <td class="border px-4 py-2 text-gray-900 dark:text-gray-200">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2 text-gray-900 dark:text-gray-200">{{ $customer->name }}</td>
                        <td class="border px-4 py-2 text-gray-900 dark:text-gray-200">{{ $customer->phone }}</td>
                        <td class="border px-4 py-2 text-gray-900 dark:text-gray-200">{{ $customer->points }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $customer->id }})" class="bg-brand-gray hover:bg-brand-gray/80 text-white font-bold py-1 px-2 rounded">Edit</button>
                            <button wire:click="delete({{ $customer->id }})" class="bg-brand-red hover:bg-brand-red/80 text-white font-bold py-1 px-2 rounded">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
