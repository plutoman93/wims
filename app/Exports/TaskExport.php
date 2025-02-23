<?php

namespace App\Exports;

use App\Models\Task;
use Rap2hpoutre\FastExcel\FastExcel;

class TaskExport
{
    public function export()
    {
        return (new FastExcel(Task::all()))->download('ข้อมูลงาน.xlsx');
    }
}
