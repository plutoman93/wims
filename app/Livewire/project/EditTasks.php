<?php

namespace App\Livewire\Project;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\TaskTypes;
use Livewire\Component;
use Carbon\Carbon;

class EditTasks extends Component
{
    public $task_id, $task_name, $task_detail, $start_date, $due_date, $task_status_id, $type_id, $user_id;

    public function mount($id)
    {
        $this->loadTaskData($id);
    }

    public function loadTaskData($id)
    {
        $data = Task::find($id);
        $this->task_id = $id;
        $this->task_name = $data->task_name;
        $this->task_detail = $data->task_detail;

        // แปลงวันที่เป็น พ.ศ. ก่อนแสดง
        $this->start_date = $data->start_date ? Carbon::parse($data->start_date)->addYears(543)->format('Y-m-d') : null;
        $this->due_date = $data->due_date ? Carbon::parse($data->due_date)->addYears(543)->format('Y-m-d') : null;

        $this->task_status_id = $data->task_status_id;
        $this->type_id = $data->type_id;
        $this->user_id = $data->user_id;
    }

    public function edit()
    {
        try {
            $task = Task::with('task_status', 'task_type')->find($this->task_id);

            // แปลงวันที่กลับเป็น ค.ศ. ก่อนบันทึก
            $start_date_formatted = $this->start_date ? Carbon::parse($this->start_date)->subYears(543)->format('Y-m-d') : null;
            $due_date_formatted = $this->due_date ? Carbon::parse($this->due_date)->subYears(543)->format('Y-m-d') : null;

            $task->update([
                'task_name' => $this->task_name,
                'task_detail' => $this->task_detail,
                'start_date' => $start_date_formatted,
                'due_date' => $due_date_formatted,
                'task_status_id' => $this->task_status_id,
                'type_id' => $this->type_id,
                'user_id' => $this->user_id,
            ]);
            return redirect()->to(route('projects'));
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function resetForm()
    {
        $this->loadTaskData($this->task_id); // โหลดข้อมูลเดิม
    }

    public function render()
    {
        return view('livewire.project.edittask', [
            'task_statuses' => TaskStatus::all(),
            'task_types' => TaskTypes::all(),
        ]);
    }
}
