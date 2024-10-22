<?php

namespace App\Livewire;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $first_name,$last_name,$photo;

    public function UpdateProfile(){

        try {
            if($this->photo){
                $fullpath =  $this->photo->store('photos','public');
                $model = User::find(auth()->Auth::user()->id);
                $model->profile_photo_path = $fullpath;
                $model->save();
                }

                // $this->photo->store('photos','public');
                User::where('id', auth()->Auth::user()->id)
                ->update([
                    'name' => $this->first_name,
                    'last_name' => $this->last_name,
                ]);
                session()->flash('message', 'เสร็จแล้ว จะไปไหนก็ไป');
        } catch (\Exception $e) {
                session()->flash('error', $e->getMessage());
        }

    }

    public function mount(){
        $this->first_name = auth ()->Auth::user()->first_name;
        $this->last_name = auth ()->Auth::user()->last_name;
    }
    public function render()
    {
        return view('livewire.profile');
    }
}
