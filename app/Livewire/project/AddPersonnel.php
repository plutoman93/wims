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
            'department_name' => 'required',
            'faculty_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'phone' => 'required|min:8|max:10',
            'user_status_name' => 'required',
        ], [
            'username.required' => "กรอกชื่อผู้ใช้",
            'title_name.required' => "กรอกคำนำหน้า",
            'first_name.required' => "กรอกชื่อจริง",
            'last_name.required' => "กรอกนามสกุล",
            'department_name.required' => "กรอกแผนก",
            'faculty_name.required' => "กรอกคณะ",
            'email.required' => "กรอกอีเมล",
            'password.required' => "กรอกรหัสผ่าน",
            'phone.required' => "กรอกเบอร์มือถือ",
            'user_status_name.required' => "เลือกระดับผู้ใช้",
        ]);

        try {
            // ดึง id ของ title, faculty, department, และ status
            $titleId = Title::where('title_name', $this->title_name)->value('title_id');
            $facultyId = Faculty::where('faculty_name', $this->faculty_name)->value('faculty_id');
            $departmentId = Department::where('department_name', $this->department_name)->value('department_id');
            $statusId = Status::where('user_status_name', $this->user_status_name)->value('user_status_id');

            // สร้างข้อมูลผู้ใช้
            User::create([
                'username' => $this->username,
                'title_id' => $titleId,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'password' => Hash::make($this->password),
                'faculty_id' => $facultyId,
                'department_id' => $departmentId,
                'user_status_id' => $statusId,
                'created_by' => Auth::id(),
            ]);

            return redirect()->to(route('personal'));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.project.addpersonnel', [
            'titles' => Title::all(),
            'faculties' => Faculty::all(),
            'departments' => Department::all(),
            'statuses' => Status::all(),
        ]);
    }
}
