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
            AccountStatusSeeder::class,
        ]);
        DB::table('users')->insert([
            [
                'username' => 'godmaster9999',
                'title_id' => 1, // ค่า foreign key
                'email' => 'god@gg.com',
                'phone' => '0999999999',
                'password' => bcrypt(value: '11111111110'),
                'first_name' => 'God',
                'last_name' => 'Master',
                'faculty_id' => 1, // ค่า foreign key
                'department_id' => 1, // ค่า foreign key
                'user_status_id' => 1, // ค่า foreign key
                'account_status_id' => 2, // ค่า foreign key
            ],
            [
                'username' => 'random1998',
                'title_id' => 2, // ค่า foreign key
                'email' => 'user2@dd.com',
                'phone' => '0888888888',
                'password' => bcrypt('12345678900'),
                'first_name' => 'Random',
                'last_name' => 'User',
                'faculty_id' => 2, // ค่า foreign key
                'department_id' => 1, // ค่า foreign key
                'user_status_id' => 2, // ค่า foreign key
                'account_status_id' => 2, // ค่า foreign key
            ],
            [
                'username' => 'admin1234',
                'title_id' => 3, // ค่า foreign key
                'email' => 'user3@dd.com',
                'phone' => '0777777777',
                'password' => bcrypt('12345678901'),
                'first_name' => 'some',
                'last_name' => 'where',
                'faculty_id' => 2, // ค่า foreign key
                'department_id' => 2, // ค่า foreign key
                'user_status_id' => 2, // ค่า foreign key
                'account_status_id' => 2, // ค่า foreign key
            ],
        ]);
    }
}
