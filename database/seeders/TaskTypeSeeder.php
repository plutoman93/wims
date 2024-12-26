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
        DB::table('task_types')->insert([
            ['type_id' => 1, 'type_name' => 'ปฏิบัติราชการ'],
            ['type_id' => 2, 'type_name' => 'ลากิจ'],
            ['type_id' => 3, 'type_name' => 'ประชุม'],
        ]);
    }
}
