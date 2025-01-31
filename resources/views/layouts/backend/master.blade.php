<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบจัดการข้อมูลกิจกรรม สาขาเทคโนโลยีคอมพิวเตอร์</title>
    @include('layouts.backend.css')
    @livewireStyles
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('layouts.backend.nav')
        @include('layouts.backend.menu')
        @yield('content')
        @include('layouts.backend.footer')
        @include('layouts.backend.js')
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
    @livewireScripts
</body>

</html>
