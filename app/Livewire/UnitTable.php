<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Unit;
use App\Models\Division;

class UnitTable extends Component
{
    use WithPagination;
    public $name, $description, $division_id, $unit_id;
    public $isEdit = false;
    public $search = '';

    protected $rules = [
        'name' => 'required|string|max:255|unique:units,name',
        'description' => 'nullable|string|max:255',
        'division_id' => 'required|exists:divisions,id',
    ];

    public function searchByEnter()
    {
        // Tidak perlu isi apa-apa, cukup trigger render ulang
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $divisions = Division::all();
        $query = Unit::with('division');
        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }
        $units = $query->paginate(10);
        return view('livewire.unit-table', [
            'units' => $units,
            'divisions' => $divisions,
        ]);
    }

    public function resetInput()
    {
        $this->name = '';
        $this->description = '';
        $this->division_id = '';
        $this->unit_id = null;
        $this->isEdit = false;
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();
        Unit::create([
            'name' => $this->name,
            'description' => $this->description,
            'division_id' => $this->division_id,
        ]);
        session()->flash('message', 'Unit created.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        $this->unit_id = $unit->id;
        $this->name = $unit->name;
        $this->description = $unit->description;
        $this->division_id = $unit->division_id;
        $this->isEdit = true;
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:units,name,' . $this->unit_id,
            'description' => 'nullable|string|max:255',
            'division_id' => 'required|exists:divisions,id',
        ]);
        $unit = Unit::findOrFail($this->unit_id);
        $unit->update([
            'name' => $this->name,
            'description' => $this->description,
            'division_id' => $this->division_id,
        ]);
        session()->flash('message', 'Unit updated.');
        $this->resetInput();
    }

    public function delete($id)
    {
        Unit::findOrFail($id)->delete();
        session()->flash('message', 'Unit deleted.');
    }
}
