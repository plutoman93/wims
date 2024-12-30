<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    // protected $guarded = ['faculty_id','faculty_name'];//ไม่สามารถแก้ข้อมูลคอลัมน์ที่กำหนดได้
    protected $fillable = ['faculty_name'];

    protected $primaryKey = 'faculty_id';

    protected $keyType = 'int';

    public $incrementing = true;

    public function user()
    {
        return $this->hasMany(User::class, 'faculty_id', 'faculty_id');
    }
    public function department()
    {
        return $this->hasMany(Department::class, 'faculty_id', 'faculty_id');
    }
}
