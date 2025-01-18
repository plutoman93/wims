<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Withpagination;
use Illuminate\Support\Facades\Auth;

class Project extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function delete($idd)
    {

        $model = User::find($idd);
        $model->deleted_by = Auth::user()->user_id;
        $model->save();
        $model->delete();
    }

    public function render()
    {
        $data = User::with('account')->paginate(10);
        return view('livewire.personal')->with(compact('data'));
    }
}
