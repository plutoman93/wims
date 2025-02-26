@extends('layouts.backend.master')
@section('content')
    <div>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">ยินดีต้อนรับ {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-xl-4 col-md-6 mb-4">
                        <a href="{{ route('projects') }}" class="text-decoration-none">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            งานทั้งหมด</div>
                                        <h1 class="text-center"> {{ $count }}</h1>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-4">
                        <a href="{{ route('projects', ['statusFilter' => 1]) }}" class="text-decoration-none">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            งานที่เสร็จแล้ว</div>
                                        <h1 class="text-center"> {{ $countCompleted }}</h1>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-4">
                        <a href="{{ route('projects', ['statusFilter' => 2]) }}" class="text-decoration-none">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            งานที่กำลังทำ</div>
                                        <h1 class="text-center">{{ $countUncompleted }}</h1>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <!-- จำนวนงานของบุคลากร -->
                    <div class="col-xl-8 col-lg-7">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">จำนวนงานของบุคลากรที่กำลังดำเนินการ</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($taskUserCounts as $task)
                                        <div class="col-md-6 col-lg-4 mb-3">
                                            <a href="{{ route('projects', ['selectedUser' => $task->user_id]) }}" class="text-decoration-none">
                                            <div class="card border-left-info shadow h-100 d-flex flex-column">
                                                <div class="card-body d-flex flex-column justify-content-center">
                                                    <div class="font-weight-bold text-info text-uppercase mb-2 text-center"
                                                        style="font-size: 16px;">
                                                        {{ $task->first_name ?? 'ไม่พบชื่อ' }}
                                                    </div>
                                                    <h1 class="text-center">{{ $task->count }}</h1>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        <!-- จำนวนงานแต่ละประเภท -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">จำนวนงานแต่ละประเภทที่กำลังดำเนินการ</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($taskCounts as $task)
                                        <div class="col-md-6 col-lg-4 mb-3">
                                            <a href="{{ route('projects', ['typeFilter' => $task->type_id]) }}" class="text-decoration-none">
                                            <div class="card border-left-info shadow h-100 d-flex flex-column">
                                                <div class="card-body d-flex flex-column justify-content-center">
                                                    <div class="font-weight-bold text-info text-uppercase mb-2 text-center"
                                                        style="font-size: 16px;">
                                                        {{ $task->type_name ?? 'ไม่พบประเภท' }}
                                                    </div>
                                                    <h1 class="text-center">{{ $task->count }}</h1>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">สถานะงาน</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <canvas id="taskStatusChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

            <!-- /.content -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('taskStatusChart').getContext('2d');
            const taskStatusChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['งานทั้งหมด', 'งานที่เสร็จแล้ว', 'งานที่กำลังทำ'],
                    datasets: [{
                        data: [{{ $count }}, {{ $countCompleted }},
                            {{ $countUncompleted }}
                        ],
                        backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e'],
                        hoverBackgroundColor: ['#2e59d9', '#17a673', '#f4b619'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: true,
                        position: 'right',
                    },
                    cutoutPercentage: 0,
                },
            });
        });
    </script>
@endsection
