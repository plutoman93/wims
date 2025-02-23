<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .email-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            color: #4CAF50;
            font-size: 24px;
        }

        p {
            font-size: 16px;
            color: #333333;
        }

        .task-details {
            margin-top: 20px;
        }

        .task-details ul {
            list-style-type: none;
            padding: 0;
        }

        .task-details li {
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777777;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .email-container {
                padding: 15px;
            }

            h1 {
                font-size: 20px;
            }

            p,
            .task-details li {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>งานใหม่ถูกสร้าง</h1>
            <p>งานใหม่ได้ถูกสร้างขึ้นในระบบแล้ว</p>
        </div>

        <div class="task-details">
            <ul>
                <li><strong>ชื่องาน:</strong> {{ $taskName }}</li>
                <li><strong>รายละเอียด:</strong> {{ $taskDetail }}</li>
                <li><strong>วันเริ่มต้น:</strong> {{ $taskStartDate }}</li>
                <li><strong>วันสิ้นสุด:</strong> {{ $taskDueDate }}</li>
                <li><strong>เจ้าของงาน:</strong> {{ $userName }}</li>
                <li><strong>ประเภทงาน:</strong> {{ $taskType }}</li>
            </ul>
        </div>

        <div class="footer">
            <p>This is an automated notification. Please do not reply.</p>
        </div>
    </div>
</body>

</html>
