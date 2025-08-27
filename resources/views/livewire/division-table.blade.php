<div class="w-full mt-8 bg-white p-6 rounded shadow">
    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="flex gap-2 mb-4">
        <input type="text" wire:model="name" placeholder="Division Name" class="border rounded px-3 py-2 flex-1">
        <input type="text" wire:model="description" placeholder="Description" class="border rounded px-3 py-2 flex-1">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            {{ $isEdit ? 'Update' : 'Add' }}
        </button>
        @if($isEdit)
            <button type="button" wire:click="resetInput" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
        @endif
    </form>
    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

    @if (session()->has('message'))
        <div class="mb-2 text-green-600">{{ session('message') }}</div>
    @endif

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
                @if ($divisions->isEmpty())
                    <tr class="hover:bg-gray-50">
                        <td colspan="3" class="px-4 py-2 border-b text-center text-gray-500">No divisions found.</td>
                    </tr>
                @else
                    @foreach($divisions as $division)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b">{{ $division->name }}</td>
                            <td class="px-4 py-2 border-b">{{ $division->description }}</td>
                            <td class="px-4 py-2 border-b">
                                <button wire:click="edit({{ $division->id }})" class="text-blue-600 hover:underline mr-2">Edit</button>
                                <button wire:click="delete({{ $division->id }})" onclick="return confirm('Delete?')" class="text-red-600 hover:underline">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
