<?php

namespace App\Livewire\Employees;

use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;

class EmployeeTable extends Component
{
    use WithPagination;

    public $search = '';
    public $showForm = false;
    public $selectedEmployeeId;

    protected $listeners = ['employeeSaved' => 'refreshTable', 'formClosed' => 'closeForm', 'deleteConfirmed' => 'deleteEmployee'];

    public function render()
    {
        $employees = Employee::with('unit')
            ->where('full_name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.employee-table', [
            'employees' => $employees,
        ]);
    }

    public function createEmployee()
    {
        $this->selectedEmployeeId = null;
        $this->showForm = true;
    }

    public function editEmployee($employeeId)
    {
        $this->selectedEmployeeId = $employeeId;
        $this->showForm = true;
    }

    public function deleteEmployee($id)
    {
        Employee::find($id)->delete();
        session()->flash('message', 'Employee deleted successfully.');
    }

    public function refreshTable()
    {
        $this->showForm = false;
    }

    public function closeForm()
    {
        $this->showForm = false;
    }
}
