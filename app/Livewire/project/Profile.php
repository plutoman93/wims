<?php

namespace App\Livewire\Project;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    use WithFileUploads;

    public $first_name, $last_name, $email, $phone, $photo, $title_name, $department_name, $faculty_name;
    public $title_id, $department_id, $faculty_id, $user_status_id;

    public function mount()
    {
        $user = Auth::user();

        // ดึงข้อมูลจาก User
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->title_id = $user->title_id;
        $this->department_id = $user->department_id;
        $this->faculty_id = $user->faculty_id;
    }

    public function updateProfile()
    {
        try {
            $user = User::with('title', 'department', 'faculty')->find(Auth::id());
            $user->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'title_id' => $this->title_id,
                'faculty_id' => $this->faculty_id,
                'department_id' => $this->department_id,
            ]);
            // แจ้งเตือนว่าอัปเดตข้อมูลสำเร็จ
            session()->flash('message', 'อัปเดตข้อมูลสำเร็จแล้ว');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function resetForm()
    {
        $this->reset(); // รีเซ็ตค่าในฟอร์ม
        $this->mount(); // ดึงข้อมูลใหม่
    }

    public function render()
    {
        return view('livewire.account_setting');
    }
}
