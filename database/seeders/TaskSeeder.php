<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('th_TH'); // ใช้ locale ภาษาไทย

        // ตรวจสอบว่ามี task_status_id ใน task_statuses แล้วหรือยัง
        $taskStatusIds = DB::table('task_statuses')->pluck('task_status_id')->toArray();
        if (empty($taskStatusIds)) {
            $this->command->info('ไม่มีข้อมูลใน task_statuses กรุณาเพิ่มข้อมูลก่อน');
            return;
        }

        // รายการชื่อและรายละเอียดงานแบบกำหนดเอง
        $taskNames = [
            'ตรวจสอบเอกสาร',
            'พัฒนาระบบ',
            'ทดสอบซอฟต์แวร์',
            'ประชุมทีม',
            'ออกแบบฐานข้อมูล',
            'เขียนรายงาน',
            'ดูแลเซิร์ฟเวอร์',
            'แก้ไขข้อผิดพลาด'
        ];

        $taskDetails = [
            'ดำเนินการตรวจสอบเอกสารให้ถูกต้อง',
            'ปรับปรุงระบบให้รองรับผู้ใช้มากขึ้น',
            'ทดสอบฟีเจอร์ใหม่ก่อนเปิดใช้งาน',
            'วางแผนการดำเนินงานในทีม',
            'ออกแบบโครงสร้างฐานข้อมูลให้เหมาะสม',
            'จัดทำเอกสารสรุปผลการดำเนินงาน',
            'ตรวจสอบสถานะเซิร์ฟเวอร์และปรับปรุงประสิทธิภาพ',
            'แก้ไขบั๊กและปรับปรุงโค้ด'
        ];

        // สร้างข้อมูลลง tasks
        foreach (range(1, 10) as $index) {
            $startDate = $faker->dateTimeBetween('now'); // กำหนด start_date เป็นวันไหนก็ได้ไม่เกิน 5 วันจากวันนี้
            $dueDate = $faker->dateTimeBetween('now', '+3 day'); // กำหนด due_date เป็นวันไหนก็ได้ในอนาคต

            DB::table('tasks')->insert([
                'task_name' => $faker->randomElement($taskNames), // สุ่มชื่อ Task จากรายการ
                'task_detail' => $faker->randomElement($taskDetails), // สุ่มรายละเอียด Task
                'start_date' => $startDate,
                'due_date' => $dueDate,
                'task_status_id' => $faker->randomElement($taskStatusIds), // ใช้ task_status_id จากฐานข้อมูล
                'type_id' => $faker->numberBetween(1, 7),
                'user_id' => $faker->numberBetween(1, 3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
