<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('task_types')->truncate();
        DB::table('task_types')->insert([
            ['type_id' => 1, 'type_name' => 'ปฏิบัติราชการ'],
            ['type_id' => 2, 'type_name' => 'ไปราชการ'],
            ['type_id' => 3, 'type_name' => 'ลาป่วย'],
            ['type_id' => 4, 'type_name' => 'ลาพักผ่อน'],
            ['type_id' => 5, 'type_name' => 'ประชุม'],
            ['type_id' => 6, 'type_name' => 'อบรม/สัมมนา'],
            ['type_id' => 7, 'type_name' => 'ลากิจ'],
        ]);
    }
}
