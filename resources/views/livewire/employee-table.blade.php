<div class="w-full mt-8 bg-white p-6 rounded shadow">

    @if ($showForm)
        <div>
            @livewire('employee-form', ['employeeId' => $selectedEmployeeId])
        </div>
    @endif

    @if (session()->has('message'))
        <div class="mb-4 text-green-600 p-2 bg-green-100 rounded">{{ session('message') }}</div>
    @endif

    <div class="flex justify-between mb-4">
        <input
            type="text"
            wire:model.lazy="search"
            placeholder="Search employees by name or email..."
            class="border rounded px-3 py-2 w-1/3"
        />
        <button wire:click="createEmployee" class="bg-blue-600 text-white px-4 py-2 rounded">Add New Employee</button>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b text-left">Name</th>
                    <th class="px-4 py-2 border-b text-left">Email</th>
                    <th class="px-4 py-2 border-b text-left">Unit</th>
                    <th class="px-4 py-2 border-b text-left">Position</th>
                    <th class="px-4 py-2 border-b text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $employee)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $employee->full_name }}</td>
                        <td class="px-4 py-2 border-b">{{ $employee->email }}</td>
                        <td class="px-4 py-2 border-b">{{ $employee->unit->name ?? '-' }}</td>
                        <td class="px-4 py-2 border-b">{{ $employee->position }}</td>
                        <td class="px-4 py-2 border-b">
                            <button wire:click="editEmployee({{ $employee->id }})" class="text-blue-600 hover:underline mr-2">Edit</button>
                            <button wire:click="deleteEmployee({{ $employee->id }})" onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 border-b text-center text-gray-500">No employees found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $employees->links() }}
    </div>
</div>
