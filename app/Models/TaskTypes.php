<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTypes extends Model
{
    use HasFactory;

    public function tasktype()
    {
        return $this->hasMany(Task::class,'type_id','type_id');
    }
}
