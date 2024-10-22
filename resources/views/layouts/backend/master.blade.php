<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบจัดการข้อมูลกิจกรรม สาขาเทคโนโลยีคอมพิวเตอร์</title>
    @include('layouts.backend.css')
    @livewireStyles
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('layouts.backend.nav')
        @include('layouts.backend.menu')
        @yield('content')
        @include('layouts.backend.footer')
        @include('layouts.backend.js')
        @livewireScripts

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    </div>
</body>

</html>
