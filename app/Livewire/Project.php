<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Withpagination;
use Illuminate\Support\Facades\Auth;

class Project extends Component
{
    use WithPagination;

    public $users;

    protected $paginationTheme = 'bootstrap';

    public function delete($idd)
    {

        $model = User::find($idd);
        $model->deleted_by = Auth::user()->user_id;
        $model->save();
        $model->delete();
    }


    public function mount()
    {
        $this->users = User::all();
    }

    public function updateStatus($user_id, $account_status_id) // อัปเดตสถานะผู้ใช้
    {
        $user = User::findOrFail($user_id);
        $user->account_status_id = $account_status_id;
        $user->save();

        // อัปเดตข้อมูลผู้ใช้ในคอมโพเนนต์
        $this->users = User::all();
    }

    public function render()
    {
        $data = User::with('account')->paginate(10);
        return view('livewire.personal')->with(compact('data'));
    }
}
