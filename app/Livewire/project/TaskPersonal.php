<?php

namespace App\Livewire\Project;

use App\Models\Task; // ตรวจสอบว่ามีการ import Model Task ถูกต้อง
use Livewire\Component;
use Livewire\WithPagination;

class TaskPersonal extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search']; // ทำให้ Search Query ถูกเก็บไว้ใน URL

    public function updatingSearch()
    {
        $this->resetPage(); // รีเซ็ตหน้าปัจจุบันเมื่อค้นหาใหม่
    }

    public function render()
    {
        $data = Task::query()
            ->when($this->search, function ($query) {
                $query->where('task_name', 'like', '%' . $this->search . '%');
            })
            ->paginate(10); // ใช้ Pagination

        return view('livewire.project.viewtask', compact('data'));
    }
}
