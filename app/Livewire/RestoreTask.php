<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Task;

class RestoreTask extends Component
{
    use WithPagination;

    public $selectedTasks = [];
    public $selectAllTasks = false;
    public $selectAll = false;

    public function updatedSelectAllTasks($value)
    {
        if ($value) {
            $this->selectedTasks = Task::onlyTrashed()->pluck('task_id')->map(fn($task_id) => (string) $task_id)->toArray();
        } else {
            $this->selectedTasks = [];
        }
        $this->selectAllTasks = $value;
    }

    public function updatedSelectedTasks()
    {
        $this->selectAllTasks = count($this->selectedTasks) === Task::onlyTrashed()->count();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedTasks = Task::onlyTrashed()->pluck('task_id')->toArray();
            $this->dispatch('alert', ['type' => 'info', 'message' => 'เลือกงานทั้งหมด']);
        } else {
            $this->selectedTasks = [];
        }
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

    public function restoreSelectedTasks()
    {
        Task::withTrashed()->whereIn('task_id', $this->selectedTasks)->restore();
        $this->selectedTasks = [];
        $this->selectAll = false;
        $this->dispatch('alert', ['type' => 'success', 'message' => 'กู้คืนงานที่เลือกเรียบร้อยแล้ว']);
    }

    public function render()
    {
        return view(
            'livewire.restore-task'
        )->with('tasks', Task::onlyTrashed()->paginate(10));
    }
}
