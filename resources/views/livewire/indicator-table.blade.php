<div class="w-full mt-8 bg-white p-6 rounded shadow">
    <form wire:submit.prevent="save" class="flex flex-col md:flex-row gap-4">
        <input type="text" wire:model="name" placeholder="Category Name" class="border rounded px-3 py-2 flex-1">
        <input type="text" wire:model="description" placeholder="Description" class="border rounded px-3 py-2 flex-1">

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ $isEdit ? 'Update' : 'Add' }}
            </button>
            @if($isEdit)
                <button type="button" wire:click="resetInput" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
            @endif
        </div>
    </form>
    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    @error('description') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
    @if (session()->has('message'))
        <div class="mb-4 text-green-600 p-2 bg-green-100 rounded">{{ session('message') }}</div>
    @endif

    <div class="mb-4 mt-2">
        <input
            type="text"
            wire:model.lazy="search"
            placeholder="Search categories..."
            class="border rounded px-3 py-2 w-full md:w-1/3"
        />
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b text-left">Name</th>
                    <th class="px-4 py-2 border-b text-left">Description</th>
                    <th class="px-4 py-2 border-b text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $category->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $category->description }}</td>
                        <td class="px-4 py-2 border-b">
                            <button wire:click="edit({{ $category->id }})" class="text-blue-600 hover:underline mr-2">Edit</button>
                            <button wire:click="delete({{ $category->id }})" onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-2 border-b text-center text-gray-500">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>
