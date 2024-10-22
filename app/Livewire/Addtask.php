<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Task;

class AddTask extends Component
{

    public $task_name, $task_detail, $start_date, $due_date, $task_file, $task_type, $status_task;

    public function add()
    {
        // Validate input fields
        $this->validate([
            'task_name' => 'required|string|max:255',
            'task_detail' => 'required|string|max:1000',
            'start_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:start_date',
            'task_file' => 'nullable|file|max:10240', // 10MB Max
            'task_type' => 'required|string',
            'status_task' => 'required|string',
        ]);

        // Save task to the database
        Task::create([
            'task_name' => $this->task_name,
            'task_detail' => $this->task_detail,
            'start_date' => $this->start_date,
            'due_date' => $this->due_date,
            'task_type' => $this->task_type,
            'status_task' => $this->status_task,
        ]);

        // Redirect or reset form fields
        session()->flash('success', 'Task added successfully');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.addtask')->with(compact('data'));
    }
}

