<?php

namespace App\Livewire\Project;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Status;
use App\Models\Title;
use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class AddPersonnel extends Component
{
    use WithFileUploads;

    public $username, $title_name, $first_name, $last_name, $email, $password, $phone, $user_status_name, $department_name, $faculty_name;

    public function add()
    {
        $this->validate([
            'username' => 'required|min:8',
            'title_name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'phone' => 'required|min:8|max:10',
            'user_status_name' => 'required',
        ], [
            'username.required' => "กรอกชื่อผู้ใช้",
            'title_name.required' => "กรอกคำนำหน้า",
            'first_name.required' => "กรอกชื่อจริง",
            'last_name.required' => "กรอกนามสกุล",
            'email.required' => "กรอกอีเมล์",
            'password.required' => "กรอกรหัสผ่าน",
            'phone.required' => "กรอกเบอร์มือถือ",
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

            $faculty = Faculty::create([
                'faculty_name' => $this->faculty_name,
            ]);

            $department = Department::create([
                'department_name' => $this->department_name,
                'faculty_id' => $faculty->id,
            ]);

            // สร้างข้อมูลในตาราง User
            $user = User::create([
                'username' => $this->username,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'password' => Hash::make($this->password), // เข้ารหัสรหัสผ่าน
                'title_id' => $title->id,  // อ้างอิง ID ของ Title
                'user_status_id' => $status->id, // อ้างอิง ID ของ Status
                'department_id' => $department->id, // อ้างอิง ID ของ Department
                'faculty_id' => $faculty->id, // อ้างอิง ID ของ Faculty
                'created_by' => Auth::id(),
            ]);
            $user->save();
            $title->save();
            $status->save();
            $faculty->save();
            $department->save();

            return redirect()->to(route('admin-dashboard')); //หลัง Login ไปที่หน้า admin-dashboard
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.project.addpersonnel');
    }
}
