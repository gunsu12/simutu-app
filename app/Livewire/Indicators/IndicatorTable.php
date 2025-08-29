<?php

namespace App\Livewire\Indicators;

use Livewire\Component;
use App\Models\Indicator_categorie; // Pastikan model ini sudah ada
use Livewire\WithPagination;

class IndicatorTable extends Component
{
    use WithPagination;

    // Properti untuk form input
    public $name, $description;
    public $categoryId;
    public $isEdit = false;

    // Properti untuk fitur tambahan
    public $search = '';

    // Aturan validasi
    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
    ];

    public function render()
    {
        $categories = Indicator_categorie::where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.indicator-table', [
            'categories' => $categories,
        ]);
    }

    // Method untuk menyimpan data (Create & Update)
    public function save()
    {
        $this->validate();

        Indicator_categorie::updateOrCreate(['id' => $this->categoryId], [
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('message', $this->isEdit ? 'Category updated successfully.' : 'Category created successfully.');
        $this->resetInput();
    }

    // Method untuk menampilkan data ke form saat edit
    public function edit($id)
    {
        $category = Indicator_categorie::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->isEdit = true;
    }

    // Method untuk menghapus data
    public function delete($id)
    {
        Indicator_categorie::find($id)->delete();
        session()->flash('message', 'Category deleted successfully.');
    }

    // Method untuk membersihkan form
    public function resetInput()
    {
        $this->name = '';
        $this->description = '';
        $this->categoryId = null;
        $this->isEdit = false;
    }
}
