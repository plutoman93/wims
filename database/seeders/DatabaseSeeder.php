<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            FacultySeeder::class,
            StatusSeeder::class,
            TaskStatusSeeder::class,
            TaskTypeSeeder::class,
            TitleSeeder::class,
            AccountStatusSeeder::class,
            // TaskSeeder::class,
        ]);
        DB::table('users')->insert([
            [
                'username' => 'admin9999',
                'title_id' => 1, // ค่า foreign key
                'email' => 'admin@gmail.com',
                'phone' => '0999999999',
                'password' => bcrypt(value: '11111111110'),
                'first_name' => 'admin99',
                'last_name' => 'แอดมิน',
                'faculty_id' => 1, // ค่า foreign key
                'department_id' => 1, // ค่า foreign key
                'user_status_id' => 1, // ค่า foreign key
                'account_status_id' => 1, // ค่า foreign key
            ],
            [
                'username' => 'user1111',
                'title_id' => 2, // ค่า foreign key
                'email' => 'user1@dd.com',
                'phone' => '0888888888',
                'password' => bcrypt(value: '12345678900'),
                'first_name' => 'ผู้ใช้สอง',
                'last_name' => 'ทั่วไป',
                'faculty_id' => 2, // ค่า foreign key
                'department_id' => 1, // ค่า foreign key
                'user_status_id' => 2, // ค่า foreign key
                'account_status_id' => 1, // ค่า foreign key
            ],
            [
                'username' => 'user2222',
                'title_id' => 3, // ค่า foreign key
                'email' => 'user2@dd.com',
                'phone' => '0777777777',
                'password' => bcrypt('12345678900'),
                'first_name' => 'ผู้ใช้หนึ่ง',
                'last_name' => 'ทั่วไป',
                'faculty_id' => 2, // ค่า foreign key
                'department_id' => 20, // ค่า foreign key
                'user_status_id' => 2, // ค่า foreign key
                'account_status_id' => 1, // ค่า foreign key
            ],
        ]);
    }
}
