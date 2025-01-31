<?php

namespace App\Livewire\Project;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class TaskPersonal extends Component
{
    use WithPagination;

    public $tasks;
    public $delete_id;

    public $search = '';

    protected $listeners = ['deleteConfirmed' => 'deleteTask'];
    protected $queryString = ['search']; // ทำให้ Search Query ถูกเก็บไว้ใน URL

    public function updatingSearch()
    {
        $this->resetPage(); // รีเซ็ตหน้าปัจจุบันเมื่อค้นหาใหม่
    }

    public function delete($task_id)
    {
        $this->delete_id = $task_id;
        $this->dispatch('show-delete-confirmation');
    }

    public function deleteTask()
    {
        $task = Task::where('task_id', $this->delete_id)->first();
        $task->deleted_by = Auth::user()->user_id; // ระบุผู้ที่ลบ

        $this->dispatch('TaskDeleted');
    }

    // public function delete($task_id)
    // {
    //     $this->dispatch('confirmDelete', ['task_id' => $task_id]);
    // }


    // public function deleteTask($task_id)
    // {
    //     $model = Task::find($task_id);

    //     if ($model) {
    //         $model->deleted_by = Auth::user()->user_id; // ระบุผู้ที่ลบ
    //         $model->save();
    //         $model->delete();
    //         Log::info('Deleting Task ID: ' . $task_id);
    //         $this->dispatch('alert', [
    //             'type' => 'success',
    //             'message' => 'ลบ Task เรียบร้อยแล้ว'
    //         ]);
    //     } else {
    //         $this->dispatch('alert', [
    //             'type' => 'error',
    //             'message' => 'ไม่พบ Task ที่ต้องการลบ'
    //         ]);
    //     }
    // }

    public function mount()
    {
        $this->tasks = Task::all();
    }

    public function taskStatus($task_id, $task_status_id)
    {
        $task = Task::findOrFail($task_id);
        $task->task_status_id = $task_status_id; // กำหนดค่า task_status_id ใหม่
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
