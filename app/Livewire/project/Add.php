<?php

namespace App\Livewire\Project;

use App\Models\User;
use App\Models\Task;
use App\Models\TaskTypes;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Add extends Component
{
    use WithFileUploads;

    public $task_name, $task_detail, $start_date, $due_date, $type_id, $created_by, $updated_by, $deleted_by, $user_id;

    public function add()
    {
        $this->validate([
            'task_name' => 'required|min:3',
            'task_detail' => 'required',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
            'type_id' => 'required|exists:task_types,type_id',
            'user_id' => 'required',
        ], [
            'task_name.required' => "กรุณากรอกชื่องาน",
            'task_detail.required' => "กรุณากรอกรายละเอียดงาน",
            'start_date.required' => "กรุณาเลือกวันที่เริ่มงาน",
            'due_date.required' => "กรุณาเลือกวันที่สิ้นสุดงาน",
            'type_id.required' => "กรุณาเลือกชนิด",
            'user_id.required' => "กรุณาเลือกเจ้าของงาน",
        ]);

        // แปลงวันที่เป็นปี พ.ศ.
        $start_date = Carbon::createFromFormat('Y-m-d', $this->start_date)->subYears(543)->format('Y-m-d');
        $due_date = Carbon::createFromFormat('Y-m-d', $this->due_date)->subYears(543)->format('Y-m-d');

        Task::create([
            'user_id' => $this->user_id,
            'task_name' => $this->task_name,
            'task_detail' => $this->task_detail,
            'start_date' => $start_date,
            'due_date' => $due_date,
            'type_id' => $this->type_id,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->to('project');
    }

    public function resetForm()
    {
        $this->reset(['task_name', 'task_detail', 'start_date', 'due_date', 'type_id', 'user_id']); // รีเซ็ตค่าในฟอร์ม
    }

    public function render()
    {
        return view('livewire.project.add', [
            'users' => User::all(),  // กรองบุคลากรที่ไม่ใช่ admin
            'task_types' => TaskTypes::all(),
        ]);
    }
}
