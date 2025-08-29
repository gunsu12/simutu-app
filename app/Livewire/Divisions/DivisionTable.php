<?php

namespace App\Livewire\Divisions;

use Livewire\Component;
use App\Models\Division;

class DivisionTable extends Component
{
    public $divisions, $name, $description, $division_id;
    public $isEdit = false;
    protected $listeners = ['deleteConfirmed' => 'delete'];

    protected $rules = [
        'name' => 'required|string|max:255|unique:divisions,name',
        'description' => 'nullable|string|max:255',
    ];

    public function render()
    {
        $this->divisions = Division::all();
        return view('livewire.division-table');
    }

    public function resetInput()
    {
        $this->name = '';
        $this->description = '';
        $this->division_id = null;
        $this->isEdit = false;
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();
        Division::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);
        session()->flash('message', 'Division created.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $division = Division::findOrFail($id);
        $this->division_id = $division->id;
        $this->name = $division->name;
        $this->description = $division->description;
        $this->isEdit = true;
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:divisions,name,' . $this->division_id,
            'description' => 'nullable|string|max:255',
        ]);
        $division = Division::findOrFail($this->division_id);
        $division->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);
        session()->flash('message', 'Division updated.');
        $this->resetInput();
    }

    public function delete($id)
    {
        Division::findOrFail($id)->delete();

        session()->flash('message', 'Division deleted.');
    }
}
