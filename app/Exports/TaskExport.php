<?php

namespace App\Exports;

use App\Models\Task;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Carbon\Carbon;

class TaskExport
{
    public function export()
    {
        Carbon::setLocale('th'); // กำหนดภาษาไทย

        // ดึงข้อมูลพร้อมความสัมพันธ์
        $tasks = Task::with(['task_status', 'task_type', 'user'])->get()->map(function ($task) {
            return [
                'ลำดับ' => $task->task_id,
                'ชื่องาน' => $task->task_name,
                'รายละเอียด' => $task->task_detail,
                'สถานะงาน' => $task->task_status->task_status_name ?? 'N/A',
                'ชนิดงาน' => $task->task_type->type_name ?? 'N/A',
                'วันเริ่มต้น' => $task->start_date ? Carbon::parse($task->start_date)->translatedFormat('j F Y') : 'N/A',
                'วันสิ้นสุด' => $task->due_date ? Carbon::parse($task->due_date)->translatedFormat('j F Y') : 'N/A',
                'เจ้าของงาน' => $task->user->first_name ?? 'N/A',
            ];
        })->toArray();

        // สร้าง spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // กำหนดหัวข้อ
        $headers = ['ลำดับ', 'ชื่องาน', 'รายละเอียด', 'สถานะงาน', 'ชนิดงาน', 'วันเริ่มต้น', 'วันสิ้นสุด', 'เจ้าของงาน'];
        $sheet->fromArray([$headers], null, 'A1');
        $sheet->fromArray($tasks, null, 'A2');

        // ✅ จัดข้อความตรงกลาง
        $lastRow = count($tasks) + 1;
        $sheet->getStyle("A1:H{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // ✅ จัดหัวข้อเป็นสีเขียว และตัวอักษรขนาด 20
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
        $sheet->getStyle('A1:H1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A1:H1')->getFill()->getStartColor()->setRGB('4CAF50');
        $sheet->getStyle('A1:H1')->getFont()->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1:H1')->getFont()->setSize(20);

        // ✅ กำหนดขนาดตัวอักษรของข้อมูลเป็น 16
        $sheet->getStyle("A2:H{$lastRow}")->getFont()->setSize(16);

        // ✅ กำหนดขนาดคอลัมน์เอง
        $columnWidths = [
            'A' => 10,  // ลำดับ
            'B' => 30,  // ชื่องาน
            'C' => 50,  // รายละเอียด
            'D' => 20,  // สถานะงาน
            'E' => 20,  // ชนิดงาน
            'F' => 25,  // วันเริ่มต้น
            'G' => 25,  // วันสิ้นสุด
            'H' => 25,  // เจ้าของงาน
        ];

        foreach ($columnWidths as $col => $width) {
            $sheet->getColumnDimension($col)->setAutoSize(false);
            $sheet->getColumnDimension($col)->setWidth($width);
        }

        // สร้างไฟล์ Excel และดาวน์โหลด
        $writer = new Xlsx($spreadsheet);
        $filename = 'ข้อมูลงาน.xlsx';

        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );
    }
}
