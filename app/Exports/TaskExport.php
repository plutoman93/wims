<?php

namespace App\Exports;

use App\Models\Task;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskExport
{
    protected $selectedUser;
    protected $statusFilter;
    protected $typeFilter;

    public function __construct($selectedUser = null, $statusFilter = null, $typeFilter = null)
    {
        $this->selectedUser = $selectedUser;
        $this->statusFilter = $statusFilter;
        $this->typeFilter = $typeFilter;
    }

    public function export()
    {
        Carbon::setLocale('th'); // กำหนดภาษาไทย

        // ดึง user ที่ login อยู่
        $user = Auth::user();

        // ตรวจสอบสิทธิ์การ export
        $query = Task::with(['task_status', 'task_type', 'user']);

        if ($user->role !== 'admin' && $user->user_status_id !== 1) {
            // ไม่ใช่ admin และ user_status_id ไม่ใช่ 1 ให้ export งานของตัวเองเท่านั้น
            $query->where('user_id', $user->user_id);
        }

        // กรองข้อมูลตามพารามิเตอร์ที่ได้รับ
        if ($this->selectedUser) {
            $query->where('user_id', $this->selectedUser);
        }

        if ($this->statusFilter) {
            $query->where('task_status_id', $this->statusFilter);
        }

        if ($this->typeFilter) {
            $query->where('type_id', $this->typeFilter);
        }

        $tasks = $query->get();

        // แปลงข้อมูลสำหรับ export
        $tasks = $tasks->map(function ($task, $index) {
            return [
                'ลำดับ' => $index + 1,
                'เจ้าของงาน' => $task->user->first_name ?? 'N/A',
                'ชื่องาน' => $task->task_name,
                'รายละเอียด' => $task->task_detail,
                'สถานะงาน' => $task->task_status->task_status_name ?? 'N/A',
                'ชนิดงาน' => $task->task_type->type_name ?? 'N/A',
                'วันเริ่มต้น' => $task->start_date ? Carbon::parse($task->start_date)->addYears(543)->translatedFormat('j F Y') : 'N/A',
                'วันสิ้นสุด' => $task->due_date ? Carbon::parse($task->due_date)->addYears(543)->translatedFormat('j F Y') : 'N/A',
            ];
        })->toArray();

        // สร้าง spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // กำหนดหัวข้อ
        $headers = ['ลำดับ', 'เจ้าของงาน', 'ชื่องาน', 'รายละเอียด', 'สถานะงาน', 'ประเภทงาน', 'วันเริ่มต้น', 'วันสิ้นสุด'];
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
            'B' => 25,  // เจ้าของงาน
            'C' => 30,  // ชื่องาน
            'D' => 50,  // รายละเอียด
            'E' => 20,  // สถานะงาน
            'F' => 20,  // ประเภทงาน
            'G' => 25,  // วันเริ่มต้น
            'H' => 25,  // วันสิ้นสุด
        ];

        foreach ($columnWidths as $col => $width) {
            $sheet->getColumnDimension($col)->setAutoSize(false);
            $sheet->getColumnDimension($col)->setWidth($width);
        }

        // สร้างไฟล์ Excel และดาวน์โหลด
        $writer = new Xlsx($spreadsheet);
        $currentDate = Carbon::now()->addYears(543)->locale('th')->translatedFormat('j F Y');
        $filename = 'ข้อมูลงาน ' . $currentDate . '.xlsx';

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
