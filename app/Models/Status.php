<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_status_id';

    public $incrementing = true; // หากใช้ auto-increment

    protected $keyType = 'int'; // หรือ 'string' หากเป็น UUID

    protected $table = 'statuses';

    public function users()
    {
        return $this->hasMany(User::class, 'user_status_id', 'user_status_id');
    }
}
