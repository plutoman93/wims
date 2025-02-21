<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Restore extends Component
{
    public $selectedUsers = [];
    public $selectAllUsers = false;

    public function updatedSelectAllUsers($value)
    {
        if ($value) {
            $this->selectedUsers = User::onlyTrashed()->pluck('user_id')->map(fn($user_id) => (string) $user_id)->toArray();
        } else {
            $this->selectedUsers = [];
        }
        $this->selectAllUsers = $value;
    }

    public function updatedSelectedUsers()
    {
        $this->selectAllUsers = count($this->selectedUsers) === User::onlyTrashed()->count();
    }

    public function hydrate()
    {
        $this->selectAllUsers = count($this->selectedUsers) === User::onlyTrashed()->count();
    }

    public function restoreUser($user_id)
    {
        $user = User::withTrashed()->find($user_id);
        if ($user) {
            $user->restore();
            session()->flash('message', 'กู้คืนบัญชีเรียบร้อยแล้ว');
        }
    }

    public function confirmRestoreSelectedUsers()
    {
        $this->dispatch('confirmRestoreSelectedUsers');
    }

    public function restoreSelectedUsers()
    {
        User::withTrashed()->whereIn('user_id', $this->selectedUsers)->restore();
        $this->selectedUsers = [];
        $this->selectAllUsers = false;
        $this->dispatch('alert', ['type' => 'success', 'message' => 'กู้คืนบัญชีที่เลือกเรียบร้อยแล้ว']);
    }

    public function render()
    {
        return view('livewire.restore', [
            'users' => User::onlyTrashed()->paginate(10),
        ]);
    }
}
