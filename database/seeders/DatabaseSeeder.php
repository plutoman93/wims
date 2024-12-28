<?php

namespace Database\Seeders;

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
        ]);
        DB::table('users')->insert([
            [
                'username' => 'godmaster9999',
                'title_id' => 1, // ค่า foreign key
                'email' => 'god@gg.com',
                'password' => bcrypt('11111111110'),
                'first_name' => 'God',
                'last_name' => 'Master',
                'faculty_id' => 1, // ค่า foreign key
                'department_id' => 1, // ค่า foreign key
                'user_status_id' => 1, // ค่า foreign key
            ],
        ]);
    }
}
