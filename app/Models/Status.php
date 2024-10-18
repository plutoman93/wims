<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public function status()
    {
        return $this->hasMany(User::class,'user_status_id','user_status_id');
    }
}
