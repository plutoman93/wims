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
    public $currentPageTasks = [];

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedTasks = array_merge($this->selectedTasks, $this->currentPageTasks);
        } else {
            $this->selectedTasks = array_diff($this->selectedTasks, $this->currentPageTasks);
        }

        $this->dispatch('updateSelectAllUI', ['selectedTasks' => $this->selectedTasks]);
    }

    public function updatedSelectedTasks()
    {
        $this->selectAll = count(array_intersect($this->selectedTasks, $this->currentPageTasks)) === count($this->currentPageTasks);

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

    public function updatingPage()
    {
        $this->selectAll = false;
        $this->selectedTasks = array_diff($this->selectedTasks, $this->currentPageTasks);
    }

    public function render()
    {
        $tasks = Task::onlyTrashed()->paginate(10);
        $this->currentPageTasks = array_column($tasks->items(), 'task_id');

        return view('livewire.restore-task', [
            'tasks' => $tasks,
        ]);
    }
}
