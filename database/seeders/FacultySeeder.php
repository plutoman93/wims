<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faculties')->truncate();
        DB::table('faculties')->insert([
            ['faculty_id' => 1, 'faculty_name' => 'เกษตรศาสตร์และเทคโนโลยี'],
            ['faculty_id' => 2, 'faculty_name' => 'เทคโนโลยีการจัดการ'],
        ]);
    }
}
