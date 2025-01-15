<?php

namespace App\Livewire\Project;

use App\Models\User;
use App\Models\Task;
use App\Models\TaskTypes;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Add extends Component
{
    use WithFileUploads;

    public $task_name, $task_detail, $start_date, $due_date, $type_id, $file, $created_by, $updated_by, $deleted_by, $user_id;
    public bool $isAdmin;

    public function mount()
    {
        $this->isAdmin = Auth::user()->user_status_id == 1; // ตรวจสอบว่าเป็น Admin หรือไม่
    }

    public function add()
    {
        $this->validate([
            'task_name' => 'required|min:3',
            'task_detail' => 'required',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
            'type_id' => 'required|exists:task_types,type_id',
        ]);

        // หากไม่เลือกบุคลากรให้บันทึก user_id เป็น Admin ที่ล็อกอินอยู่
        $assignedUserId = $this->user_id ?? Auth::id();

        $task = Task::create([
            'task_name' => $this->task_name,
            'task_detail' => $this->task_detail,
            'start_date' => $this->start_date,
            'due_date' => $this->due_date,
            'type_id' => $this->type_id,
            'user_id' => $assignedUserId,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        if ($this->file) {
            $filePath = $this->file->store('tasks', 'public');
            $task->task_file = $filePath;
            $task->save();
        }

        return redirect()->to('admin-dashboard');
    }

    public function resetForm()
    {
        $this->reset(['task_name', 'task_detail', 'start_date', 'due_date', 'type_id']); // รีเซ็ตค่าในฟอร์ม
    }

    public function render()
    {
        return view('livewire.project.add', [
            'users' => User::where('user_status_id', '!=', 1)->get(),  // กรองบุคลากรที่ไม่ใช่ admin
            'task_types' => TaskTypes::all(),
            'isAdmin' => $this->isAdmin,
        ]);
    }
}
