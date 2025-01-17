<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('titles')->truncate();
        DB::table('titles')->insert([
            ['title_id' => 1, 'title_name' => 'นาย'],
            ['title_id' => 2, 'title_name' => 'นาง'],
            ['title_id' => 3, 'title_name' => 'นางสาว'],
        ]);
    }
}
