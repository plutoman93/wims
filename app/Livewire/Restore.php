<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Log;

class Restore extends Component
{
    public $selectedUsers = [];
    public $selectedTasks = [];
    public $selectAllUsers = false;
    public $selectAllTasks = false;

    public function updatedSelectAllUsers($value)
    {
        if ($value) {
            $this->selectedUsers = User::onlyTrashed()->pluck('user_id')->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }

    public function updatedSelectAllTasks($value)
    {
        if ($value) {
            $this->selectedTasks = Task::onlyTrashed()->pluck('task_id')->toArray();
        } else {
            $this->selectedTasks = [];
        }
    }

    public function restoreUser($user_id)
    {
        $user = User::withTrashed()->find($user_id);
        if ($user) {
            $user->restore();
            session()->flash('message', 'กู้คืนบัญชีเรียบร้อยแล้ว');
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

    public function confirmRestoreSelectedUsers()
    {
        $this->dispatch('confirmRestoreSelectedUsers');
    }

    public function confirmRestoreSelectedTasks()
    {
        $this->dispatch('confirmRestoreSelectedTasks');
    }

    public function restoreSelectedUsers()
    {
        User::withTrashed()->whereIn('user_id', $this->selectedUsers)->restore();
        $this->selectedUsers = [];
        $this->selectAllUsers = false;
        $this->dispatch('alert', ['type' => 'success', 'message' => 'กู้คืนบัญชีที่เลือกเรียบร้อยแล้ว']);
    }

    public function restoreSelectedTasks()
    {
        Task::withTrashed()->whereIn('task_id', $this->selectedTasks)->restore();
        $this->selectedTasks = [];
        $this->selectAllTasks = false;
        $this->dispatch('alert', ['type' => 'success', 'message' => 'กู้คืนงานที่เลือกเรียบร้อยแล้ว']);
    }

    public function render()
    {
        return view('livewire.restore', [
            'users' => User::onlyTrashed()->get(),
            'tasks' => Task::onlyTrashed()->get(),
        ]);
    }
}
