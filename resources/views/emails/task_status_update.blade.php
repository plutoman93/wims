<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การอัปเดตสถานะงาน</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #007bff;
        }

        p {
            font-size: 18px;
            color: #555;
        }

        .task-list {
            margin-top: 20px;
        }

        .task-item {
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .task-item h3 {
            margin: 0;
            color: #007bff;
            font-size: 20px;
        }

        .task-details {
            margin-top: 10px;
        }

        .task-details p {
            margin: 5px 0;
            font-size: 16px;
        }

        .task-details .label {
            font-weight: bold;
            color: #555;
        }

        .task-status {
            margin-top: 10px;
            font-weight: bold;
            color: #ec0d0d;
            font-size: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>แจ้งเตือนข้อมูลงาน</h1>
        <p>นี่คืองานที่มีสถานะ "ยังไม่เสร็จสิ้น" ของคุณ</p>

        <div class="task-list">
            @foreach ($tasks as $task)
                <div class="task-item">
                    <h3>{{ $task->task_name }}</h3>
                    <div class="task-details">
                        <p><span class="label">รายละเอียดงาน:</span> {{ $task->task_detail }}</p>
                        <p><span class="label">ประเภทงาน:</span> {{ $task->task_type->type_name }}</p>
                        <p><span class="label">วันที่เริ่มงาน:</span>
                            {{ \Carbon\Carbon::parse($task->start_date)->locale('th')->isoFormat('D MMMM G') }}</p>
                        <p><span class="label">วันครบกำหนด:</span>
                            {{ \Carbon\Carbon::parse($task->due_date)->locale('th')->isoFormat('D MMMM G') }}</p>
                    </div>
                    <div class="task-status">
                        สถานะ: {{ $task->task_status->task_status_name }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>

</html>
