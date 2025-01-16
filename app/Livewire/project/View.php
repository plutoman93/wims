<?php

namespace App\Livewire\Project;
use App\Models\User;
use Livewire\Component;

class View extends Component
{
    public  $idd, $data,$username, $first_name, $last_name, $title_name, $phone, $department_name, $faculty_name, $email, $user_status_name;

    public function mount($id)
    {
       $this->data = $data = User::with(['title','department','faculty','status'])->find($id);

        $this->idd = $id;
        $this->username = $data->username;
        $this->first_name = $data->first_name;
        $this->last_name = $data->last_name;
        $this->title_name = $data->title ? $data->title->title_name : null;
        $this->phone = $data->phone;
        $this->department_name = $data->department ? $data->department->department_name : null;
        $this->faculty_name = $data->faculty ? $data->faculty->faculty_name : null;
        $this->email = $data->email;
        $this->user_status_name = $data->user_status_name;
    }

    public function render()
    {
        return view('livewire.project.view');
    }
}
