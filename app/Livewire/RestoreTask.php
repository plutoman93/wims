<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Task;

class RestoreTask extends Component
{
    use WithPagination;

    public $selectedTasks = [];
    public $selectAll = false;

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedTasks = Task::onlyTrashed()->pluck('task_id')->toArray();
        } else {
            $this->selectedTasks = [];
        }

        $this->dispatch('updateSelectAllUI', ['selectedTasks' => $this->selectedTasks]);
    }

    public function updatedSelectedTasks()
    {
        $tasksCount = Task::onlyTrashed()->count();
        $this->selectAll = count($this->selectedTasks) === $tasksCount;

        $this->dispatch('updateSelectAllUI', ['selectedTasks' => $this->selectedTasks]);
    }

    public function restoreTask($task_id)
    {
        $task = Task::withTrashed()->find($task_id);
        if ($task) {
            $task->restore();
            session()->flash('message', 'กู้คืนงานเรียบร้อยแล้ว');
        }
    }

    public function confirmRestoreSelectedTasks()
    {
        $this->dispatch('confirmRestoreSelectedTasks');
    }

    // public function restoreSelectedTasks()
    // {
    //     Task::withTrashed()->whereIn('task_id', $this->selectedTasks)->restore();
    //     $this->selectedTasks = [];
    //     $this->selectAll = false;

    //     // ส่ง event ไปอัปเดต checkbox ใน UI
    //     $this->dispatch('updateSelectAllUI', ['selectedTasks' => $this->selectedTasks]);

    //     // แจ้งเตือนสำเร็จ
    //     $this->dispatch('alert', ['type' => 'success', 'message' => 'กู้คืนงานที่เลือกเรียบร้อยแล้ว']);
    // }

    public function restoreSelectedTasks()
    {
        if (!empty($this->selectedTasks)) {
            Task::withTrashed()->whereIn('task_id', $this->selectedTasks)->restore();
            $this->selectedTasks = [];
            $this->selectAll = false;

            $this->dispatch('updateSelectAllUI', ['selectedTasks' => $this->selectedTasks]);
            $this->dispatch('alert', ['type' => 'success', 'message' => 'กู้คืนงานที่เลือกเรียบร้อยแล้ว']);
        } else {
            $this->dispatch('alert', ['type' => 'warning', 'message' => 'กรุณาเลือกงานที่ต้องการกู้คืน']);
        }
    }

    public function render()
    {
        return view('livewire.restore-task', [
            'tasks' => Task::onlyTrashed()->get(),
        ]);
    }
}
