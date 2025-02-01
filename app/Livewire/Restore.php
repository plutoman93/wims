<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Task;
use Livewire\Component;

class Restore extends Component
{
    public $users, $tasks;

    public function mount()
    {
        $this->users = collect();
        $this->tasks = collect();
        $this->showTrash();
    }

    public function showTrash()
    {
        $this->users = User::onlyTrashed()->get();
        $this->tasks = Task::onlyTrashed()->get();

        // return view('livewire.restore')->with('users', $this->users)->with('tasks', $this->tasks);
    }

    public function deleteUser()
    {
        $user = User::onlyTrashed()->get();
        $user->forceDelete();
    }

    public function restoreUser($id)
    {
        $user = User::onlyTrashed()->find($id);
        $user->restore();
        $this->refreshUsers();
    }

    public function restoreTask($id)
    {
        $task = Task::onlyTrashed()->find($id);
        $task->restore();
        $this->refreshUsers();
    }

    public function refreshUsers()
    {
        $this->users = User::onlyTrashed()->get(); // โหลดข้อมูล User ที่ถูกลบ
    }

    public function render()
    {
        return view('livewire.restore')->with('users', $this->users)->with('tasks', $this->tasks);
    }
}
