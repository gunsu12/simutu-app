<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Unit;
use Illuminate\Validation\Rule;

class EmployeeForm extends Component
{
    public $employeeId;
    public $full_name, $email, $phone_number, $unit_id, $position, $status;
    public $isEdit = false;

    public function mount($employeeId = null)
    {
        if ($employeeId) {
            $this->employeeId = $employeeId;
            $employee = Employee::find($employeeId);
            $this->full_name = $employee->full_name;
            $this->email = $employee->email;
            $this->phone_number = $employee->phone_number;
            $this->unit_id = $employee->unit_id;
            $this->position = $employee->position;
            $this->status = $employee->status;
            $this->isEdit = true;
        }
    }

    public function render()
    {
        $units = Unit::all();
        return view('livewire.employee-form', [
            'units' => $units
        ]);
    }

    public function save()
    {
        $rules = [
            'full_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('employees')->ignore($this->employeeId),
            ],
            'unit_id' => 'required|exists:units,id',
            'phone_number' => 'nullable|string',
            'position' => 'nullable|string',
        ];

        $this->validate($rules);

        Employee::updateOrCreate(['id' => $this->employeeId], [
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'unit_id' => $this->unit_id,
            'position' => $this->position,
        ]);

        session()->flash('message', $this->isEdit ? 'Employee updated successfully.' : 'Employee created successfully.');
        $this->dispatch('employeeSaved');
    }

    public function close()
    {
        $this->dispatch('formClosed');
    }
}
