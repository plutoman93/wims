<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // ตรวจสอบว่ามี task_status_id ใน task_statuses แล้วหรือยัง
        $taskStatusIds = DB::table('task_statuses')->pluck('task_status_id')->toArray();
        if (empty($taskStatusIds)) {
            $this->command->info('ไม่มีข้อมูลใน task_statuses กรุณาเพิ่มข้อมูลก่อน');
            return;
        }

        // สร้างข้อมูลลง tasks
        foreach (range(1, 20) as $index) {
            DB::table('tasks')->insert([
                'task_name' => $faker->sentence(10), // ชื่อ Task แบบสุ่ม
                'task_detail' => substr($faker->paragraph, 0, 255), // รายละเอียด Task แบบสุ่ม
                'start_date' => $faker->date,
                'due_date' => $faker->date,
                'task_status_id' => $faker->numberBetween(1, 2), // เลือก task_status_id ที่มีอยู่ในตาราง task_statuses
                'type_id' => $faker->numberBetween(1, 3), // กำหนดค่าตามที่ต้องการ
                'user_id' => $faker->numberBetween(1, 3), // กำหนดค่าตามที่ต้องการ
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
