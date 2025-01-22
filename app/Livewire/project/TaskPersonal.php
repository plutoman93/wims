<?php

namespace App\Livewire\Project;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskPersonal extends Component
{
    use WithPagination;

    public $tasks;

    public $search = '';

    protected $queryString = ['search']; // ทำให้ Search Query ถูกเก็บไว้ใน URL

    public function updatingSearch()
    {
        $this->resetPage(); // รีเซ็ตหน้าปัจจุบันเมื่อค้นหาใหม่
    }

    public function delete($task_id)
    {
        $model = Task::find($task_id);
        $model->deleted_by = Auth::user()->user_id;
        $model->save();
        $model->delete();
    }

    public function mount()
    {
        $this->tasks = Task::all();
    }

    public function taskStatus($task_id, $task_status_id)
    {
        $task = Task::findOrFail($task_id);
        $task->task_status_id = $task_status_id;
        $task->save();

        $this->tasks = Task::all();
    }

    public function render()
    {
        $data = Task::query()
            ->when(Auth::user()->user_status_id !== 1, function ($query) {
                $query->where('user_id', Auth::id()); // ดูเฉพาะ Task ของตัวเอง ถ้าไม่ใช่ admin
            })
            ->when($this->search, function ($query) {
                $query->where('task_name', 'like', '%' . $this->search . '%');
            })
            ->paginate(10); // ใช้ Pagination

        return view('livewire.project.viewtask', compact('data'));
    }
}
