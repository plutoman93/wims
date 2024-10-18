<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public function account()
    {
        return $this->hasMany(User::class,'account_status_id','account_status_id');
    }
}
