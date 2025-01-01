<?php

namespace App\Livewire\Project;

use App\Models\Task;
use App\Models\TaskTypes;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Add extends Component
{
    use WithFileUploads;

    public $task_name, $task_detail, $start_date, $due_date, $type_id, $file, $created_by, $updated_by, $deleted_by;

    public function add()
    {
        $this->validate([
            'task_name' => 'required|min:3',
            'task_detail' => 'required',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
            'type_id' => 'required|exists:task_types,type_id',
        ]);

        // ดึง user_id จากผู้ที่ล็อกอิน
        $user_id = Auth::id();  // ใช้ Auth::id() เพื่อดึง user_id

        // บันทึก Task
        $task = Task::create([
            'task_name' => $this->task_name,
            'task_detail' => $this->task_detail,
            'start_date' => $this->start_date,
            'due_date' => $this->due_date,
            'type_id' => $this->type_id,
            'user_id' => $user_id,  // ใส่ค่า user_id
            'created_by' => $user_id,  // ใส่ค่า user_id
            'updated_by' => $user_id,  // ใส่ค่า user_id
        ]);

        // ถ้ามีการอัพโหลดไฟล์
        if ($this->file) {
            $filePath = $this->file->store('tasks', 'public');
            $task->task_file = $filePath;
            $task->save();
        }
        return redirect()->to('admin-dashboard'); // เปลี่ยน URL ตามที่ต้องการ
    }
    public function render()
    {
        return view('livewire.project.add', [
            'task_types' => TaskTypes::all(),  // ส่งชนิดงานที่มีอยู่ทั้งหมดไปยัง View
        ]);
    }
}
