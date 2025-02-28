<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TaskTypes;
use Livewire\WithPagination;

class TypeManagement extends Component
{
    use WithPagination;

    public $type_name;
    public $selectedTypeId = null;
    public $isEditMode = false;

    protected $rules = [
        'type_name' => 'required|min:3',
    ];

    public function resetInputFields()
    {
        $this->type_name = '';
        $this->selectedTypeId = null;
        $this->isEditMode = false;
    }

    public function store()
    {
        $this->validate();

        TaskTypes::create([
            'type_name' => $this->type_name,
        ]);

        session()->flash('message', 'เพิ่มประเภทงานเรียบร้อยแล้ว');
        $this->resetInputFields();
    }

    public function edit($type_id)
    {
        $type = TaskTypes::findOrFail($type_id);
        $this->selectedTypeId = $type_id;
        $this->type_name = $type->type_name;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate();

        $type = TaskTypes::findOrFail($this->selectedTypeId);
        $type->update([
            'type_name' => $this->type_name,
        ]);

        session()->flash('message', 'แก้ไขประเภทงานเรียบร้อยแล้ว');
        $this->resetInputFields();
    }

    public function render()
    {
        return view('livewire.type-management', [
            'task_types' => TaskTypes::paginate(10),
        ]);
    }
}
