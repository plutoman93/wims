<?php

namespace App\Livewire\Project;

use Livewire\Component;
use App\Models\User;
use App\Models\Status;
use App\Models\Title;

class AddPersonnel extends Component
{
    public $username, $title_name, $first_name, $last_name, $email, $password, $user_status_name;

    public function add()
    {
        $this->validate([
            'username' => 'required|min:8',
            'title_name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'user_status_name' => 'required',
        ], [
            'username.required' => "กรอกชื่อผู้ใช้",
            'title_name.required' => "กรอกคำนำหน้า",
            'first_name.required' => "กรอกชื่อจริง",
            'last_name.required' => "กรอกนามสกุล",
            'email.required' => "กรอกอีเมล์",
            'password.required' => "กรอกรหัสผ่าน",
            'user_status_name.required' => "เลือกระดับผู้ใช้",
        ]);

        try {
            // สร้างข้อมูลในตาราง Title
            $title = Title::create([
                'title_name' => $this->title_name,
            ]);

            // สร้างข้อมูลในตาราง Status
            $status = Status::create([
                'user_status_name' => $this->user_status_name,
            ]);

            // สร้างข้อมูลในตาราง User
            $user = User::create([
                'username' => $this->username,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'password' => bcrypt($this->password), // เข้ารหัสรหัสผ่าน
                'title_id' => $title->id,  // อ้างอิง ID ของ Title
                'status_id' => $status->id, // อ้างอิง ID ของ Status
            ]);

        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.project.add-personnel');
    }
}
