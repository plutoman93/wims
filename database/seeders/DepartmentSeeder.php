<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->truncate();
        DB::table('departments')->insert([
            ['department_id' => 1, 'department_name' => 'วิทยาการคอมพิวเตอร์', 'faculty_id' => 1],
            ['department_id' => 2, 'department_name' => 'เทคโนโลยีคอมพิวเตอร์', 'faculty_id' => 1],
            ['department_id' => 3, 'department_name' => 'พืชศาสตร์', 'faculty_id' => 1],
            ['department_id' => 4, 'department_name' => 'สัตวศาสตร์', 'faculty_id' => 1],
            ['department_id' => 5, 'department_name' => 'ประมง', 'faculty_id' => 1],
            ['department_id' => 6, 'department_name' => 'เทคโนโลยีการอาหาร', 'faculty_id' => 1],
            ['department_id' => 7, 'department_name' => 'เทคโนโลยีชีวภาพการเกษตร', 'faculty_id' => 1],
            ['department_id' => 8, 'department_name' => 'เคมีประยุกต์', 'faculty_id' => 1],
            ['department_id' => 9, 'department_name' => 'เทคโนโลยีและการจัดการสิ่งแวดล้อม', 'faculty_id' => 1],
            ['department_id' => 10, 'department_name' => 'การออกแบบภูมิทัศน์และการจัดสวน', 'faculty_id' => 1],
            ['department_id' => 11, 'department_name' => 'เทคโนโลยีสิ่งทอและออกแบบแฟชั่น', 'faculty_id' => 1],
            ['department_id' => 12, 'department_name' => 'วิศวกรรมเครื่องกล', 'faculty_id' => 1],
            ['department_id' => 13, 'department_name' => 'วิศวกรรมเครื่องจักรกลเกษตร', 'faculty_id' => 1],
            ['department_id' => 14, 'department_name' => 'วิศวกรรมไฟฟ้า', 'faculty_id' => 1],
            ['department_id' => 15, 'department_name' => 'เทคโนโลยีเครื่องกล', 'faculty_id' => 1],
            ['department_id' => 16, 'department_name' => 'เทคโนโลยีไฟฟ้า', 'faculty_id' => 1],
            ['department_id' => 17, 'department_name' => 'การจัดการสมัยใหม่', 'faculty_id' => 2],
            ['department_id' => 18, 'department_name' => 'การจัดการนวัตกรรมการค้า', 'faculty_id' => 2],
            ['department_id' => 19, 'department_name' => 'การตลาด', 'faculty_id' => 2],
            ['department_id' => 20, 'department_name' => 'การจัดการการท่องเที่ยวและการโรงแรม', 'faculty_id' => 2],
            ['department_id' => 21, 'department_name' => 'บัญชี', 'faculty_id' => 2],
            ['department_id' => 22, 'department_name' => 'ภาษาอังกฤษเพื่อการสื่อสาร', 'faculty_id' => 2],
            ['department_id' => 23, 'department_name' => 'เทคโนโลยีมัลติมีเดีย', 'faculty_id' => 2],
            ['department_id' => 24, 'department_name' => 'เทคโนโลยีดิจิทัลเพื่อการจัดการธุรกิจและบริการ', 'faculty_id' => 2],
        ]);
    }
}
