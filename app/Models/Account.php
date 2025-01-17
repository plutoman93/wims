<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $primaryKey = 'account_status_id';

    protected $keyType = 'int';

    public $incrementing = true;

    public function account()
    {
        return $this->hasMany(User::class, 'account_status_id', 'account_status_id');
    }
}
