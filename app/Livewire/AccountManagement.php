<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Task;
use Livewire\Component;
use Livewire\Withpagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AccountManagement extends Component
{
    use WithPagination;

    public $users, $delete_id;

    protected $paginationTheme = 'bootstrap';

    public function delete($user_id)    // ลบ User
    {
        $this->delete_id = $user_id;
        $this->dispatch('confirmDelete', $user_id); // ส่ง Event ไปยัง SweetAlert
    }

    public function deleteUser() // ลบ User และงานทั้งหมดของผู้ใช้
    {
        $user = User::find($this->delete_id); // ค้นหา User ที่ต้องการลบ

        if ($user) {
            // ลบงานทั้งหมดของผู้ใช้
            $tasks = Task::where('user_id', $this->delete_id)->get();
            foreach ($tasks as $task) {
                $task->deleted_by = Auth::user()->user_id; // ระบุผู้ที่ลบ
                $task->save();
                $task->delete(); // ลบ task
            }

            // ลบผู้ใช้
            $user->deleted_by = Auth::user()->user_id; // ระบุผู้ที่ลบ
            $user->save();
            $user->delete(); // ลบ user

            Log::info('Deleting User ID: ' . $this->delete_id . ' and their tasks.');
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'ลบ User และงานทั้งหมดเรียบร้อยแล้ว'
            ]);
        } else {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'ไม่พบ User ที่ต้องการลบ'
            ]);
        }
    }

    public function mount() // โหลดข้อมูลผู้ใช้
    {
        $this->users = User::all(); // โหลดข้อมูลผู้ใช้ทั้งหมด
    }

    public function updateStatus($user_id, $account_status_id) // อัปเดตสถานะผู้ใช้
    {
        $user = User::findOrFail($user_id); // ค้นหา User ที่ต้องการอัปเดต
        $user->account_status_id = $account_status_id; // กำหนดค่าสถานะผู้ใช้
        $user->save();

        // อัปเดตข้อมูลผู้ใช้ในคอมโพเนนต์
        $this->users = User::all();
    }

    public function render()
    {
        $data = User::with('account')->paginate(10); // โหลดข้อมูลผู้ใช้และสถานะผู้ใช้
        return view('livewire.personal')->with(compact('data')); // ส่งข้อมูลไปยัง View
    }
}
