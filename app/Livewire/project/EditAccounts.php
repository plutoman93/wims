<?php

namespace App\Livewire\Project;

use App\Models\User;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Title;
use App\Models\Status;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditAccounts extends Component
{
    use WithFileUploads;
    public $idd, $username, $first_name, $last_name, $title_name, $phone, $department_name, $faculty_name, $email, $user_status_name, $password;

    public function mount($id)
    {
        // dd($id);
        $data = User::find($id);
        $this->idd = $id;
        $this->username = $data->username;
        $this->first_name = $data->first_name;
        $this->last_name = $data->last_name;
        $this->title_name = $data->title_name;
        $this->phone = $data->phone;
        $this->department_name = $data->department_name;
        $this->faculty_name = $data->faculty_name;
        $this->email = $data->email;
        $this->user_status_name = $data->user_status_name;
        $this->password = $data->password;
    }

    public function edit()
    {
        try {
            User::where('id', $this->idd)->update([
                'username' => $this->username,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'title_name' => $this->title_name,
                'phone' => $this->phone,
                'department_name' => $this->department_name,
                'faculty_name' => $this->faculty_name,
                'email' => $this->email,
                'user_status_name' => $this->user_status_name,
                'password' => $this->password,
            ]);
            return redirect()->to(route('personal'));
        } catch (\Exception $data) {
            dd($data);
        }
    }
    public function render()
    {
        // $data = User::with(['department','faculty','status','title'])->get(10); // ดึงข้อมูลทั้งหมด
        // dd($data);
        return view('livewire.project.edit');
    }
}
