<?php

namespace App\Livewire\Project;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\TaskTypes;
use Livewire\Component;

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
        $this->start_date = date('Y-m-d', strtotime($this->start_date . ' +543 years'));
        $this->due_date = date('Y-m-d', strtotime($this->due_date . ' +543 years'));
        $this->task_status_id = $data->task_status_id;
        $this->type_id = $data->type_id;
        $this->user_id = $data->user_id;
    }

    public function edit()
    {
        try {
            $task = Task::with('task_status', 'task_type')->find($this->task_id);

            $task->update([
                'task_name' => $this->task_name,
                'task_detail' => $this->task_detail,
                'start_date' => $this->start_date,
                'due_date' => $this->due_date,
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
