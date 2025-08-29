<div class="w-full mt-8 bg-white p-6 rounded shadow">

    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="flex gap-2 mb-4">
        <input type="text" wire:model="name" placeholder="Unit Name" class="border rounded px-3 py-2 flex-1">
        <input type="text" wire:model="description" placeholder="Description" class="border rounded px-3 py-2 flex-1">
        <select wire:model="division_id" class="border rounded px-3 py-2 flex-1">
            <option value="">-- Select Division --</option>
            @foreach($divisions as $division)
                <option value="{{ $division->id }}">{{ $division->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            {{ $isEdit ? 'Update' : 'Add' }}
        </button>
        @if($isEdit)
            <button type="button" wire:click="resetInput" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
        @endif
    </form>
    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    @error('division_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

    @if (session()->has('message'))
        <div class="mb-2 text-green-600">{{ session('message') }}</div>
    @endif
<div class="mb-4">
        <input
            type="text"
            wire:model.lazy="search"
            wire:keydown.enter="$refresh"
            placeholder="Search unit..."
            class="border rounded px-3 py-2 w-full md:w-1/3"
        />
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b text-left">Name</th>
                    <th class="px-4 py-2 border-b text-left">Description</th>
                    <th class="px-4 py-2 border-b text-left">Division</th>
                    <th class="px-4 py-2 border-b text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($units->isEmpty())
                    <tr class="hover:bg-gray-50">
                        <td colspan="4" class="px-4 py-2 border-b text-center text-gray-500">No units found.</td>
                    </tr>
                @else
                    @foreach($units as $unit)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b">{{ $unit->name }}</td>
                            <td class="px-4 py-2 border-b">{{ $unit->description }}</td>
                            <td class="px-4 py-2 border-b">{{ $unit->division->name ?? '-' }}</td>
                            <td class="px-4 py-2 border-b">
                                <button wire:click="edit({{ $unit->id }})" class="text-blue-600 hover:underline mr-2">Edit</button>
                                <button wire:click="delete({{ $unit->id }})" onclick="return confirm('Delete?')" class="text-red-600 hover:underline">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="mt-4 bg:white p-2 rounded">
        {{ $units->links() }}
    </div>
</div>
