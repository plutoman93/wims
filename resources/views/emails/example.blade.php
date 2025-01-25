<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Example Mail</title>
</head>

<body>
    <h1>สวัสดี {{ $data['name'] }}</h1>
    <p>นี่คือตัวอย่างข้อความในอีเมลของคุณ:</p>
    <p>{{ $data['message'] }}</p>
</body>

</html>
