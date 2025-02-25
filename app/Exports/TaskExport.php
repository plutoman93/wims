<?php

namespace App\Exports;

use App\Models\Task;
use Rap2hpoutre\FastExcel\FastExcel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TaskExport
{
    public function export()
    {
        // สร้าง spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // กำหนดข้อมูลในแต่ละแถว
        $tasks = Task::all()->toArray();
        $sheet->fromArray($tasks, null, 'A2');

        // ปรับรูปแบบหัวข้อ
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Task Name');
        $sheet->setCellValue('C1', 'Created At');

        // กำหนดรูปแบบให้กับหัวข้อ
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);
        $sheet->getStyle('A1:C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A1:C1')->getFill()->getStartColor()->setRGB('4CAF50');  // สีเขียว
        $sheet->getStyle('A1:C1')->getFont()->getColor()->setRGB('FFFFFF');  // สีตัวอักษรเป็นขาว

        // ปรับขนาดความกว้างคอลัมน์
        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(20);

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
