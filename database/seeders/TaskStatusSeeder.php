<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('task_statuses')->insert([
            ['task_status_id' => 1, 'task_status_name' => 'เสร็จสิ้น'],
            ['task_status_id' => 2, 'task_status_name' => 'ยังไม่เสร็จสิ้น'],
        ]);
    }
}
