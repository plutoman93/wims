<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // protected $fillable = ['department_id'];

    // protected $guarded = ['department_id','department_name']; //ไม่สามารถแก้ข้อมูลคอลัมน์ที่กำหนดได้

    protected $primaryKey = 'department_id';

    protected $keyType = 'int';

    public $incrementing = true;

    public function user()
    {
        return $this->hasMany(User::class, 'department_id', 'department_id');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'faculty_id');
    }
}
