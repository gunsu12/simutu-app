<div class="p-6 mb-6 border rounded shadow bg-gray-50">
    <h3 class="text-xl font-semibold mb-4">{{ $isEdit ? 'Edit Employee' : 'Create New Employee' }}</h3>
    <form wire:submit.prevent="save">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="full_name" class="block mb-1">Full Name</label>
                <input id="full_name" type="text" wire:model="full_name" class="border rounded px-3 py-2 w-full">
                @error('full_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="email" class="block mb-1">Email</label>
                <input id="email" type="email" wire:model="email" class="border rounded px-3 py-2 w-full">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="phone_number" class="block mb-1">Phone Number</label>
                <input id="phone_number" type="text" wire:model="phone_number" class="border rounded px-3 py-2 w-full">
                @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="unit_id" class="block mb-1">Unit</label>
                <select id="unit_id" wire:model="unit_id" class="border rounded px-3 py-2 w-full">
                    <option value="">-- Select Unit --</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                    @endforeach
                </select>
                @error('unit_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="position" class="block mb-1">Position</label>
                <input id="position" type="text" wire:model="position" class="border rounded px-3 py-2 w-full">
                @error('position') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mt-4 flex justify-end gap-2">
            <button type="button" wire:click="close" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ $isEdit ? 'Update' : 'Save' }}
            </button>
        </div>
    </form>
</div>
