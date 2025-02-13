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
            ['department_id' => 1, 'department_name' => 'วิทยาการคอมพิวเตอร์','faculty_id' => 1],
            ['department_id' => 2, 'department_name' => 'เทคโนโลยีคอมพิวเตอร์','faculty_id' => 1],
        ]);
    }
}
