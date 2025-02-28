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
                    <h1 class="h3 mb-0 text-gray-800">ยินดีต้อนรับ {{ Auth::user()->first_name }}
                        {{ Auth::user()->last_name }} </h1>
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
                        <!-- กล่องหลักทั้งหมด -->
                        <div class="card shadow mb-4">
                            <!-- ส่วนหัวของการ์ด -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">สรุปตารางงาน</h6>
                            </div>

                            <!-- ส่วนเนื้อหาของการ์ด -->
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-4 mb-3">
                                        <select class="form-control" wire:model.live="selectedUser">
                                            <option value="">เลือกผู้ใช้</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->user_id }}">{{ $user->first_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <select class="form-control" wire:model="dateFilter">
                                            <option value="">เลือกวันที่</option>
                                            @foreach ($dates ?? [] as $date)
                                                <option value="{{ $date }}">{{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between my-3">
                                    <div>
                                        <button class="btn btn-secondary me-1" wire:click="prevDate"
                                            @if($dateFilter == $dates->first()) disabled @endif>
                                            ก่อนหน้า
                                        </button>

                                        <button class="btn btn-secondary" wire:click="nextDate"
                                            @if($dateFilter == $dates->last()) disabled @endif>
                                            ถัดไป
                                        </button>
                                    </div>

                                    <span class="fw-bold flex-grow-1 text-center w-50">
                                        วันที่ {{ \Carbon\Carbon::parse($dateFilter)->translatedFormat('d F') }}
                                        {{ \Carbon\Carbon::parse($dateFilter)->format('Y') }}
                                    </span>
                                </div>

                                <div class="d-flex">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead class="bg-secondary text-white">
                                                <tr class="text-center">
                                                    <th>ลำดับ</th>
                                                    <th>เจ้าของงาน</th>
                                                    <th>ชื่องาน</th>
                                                    <th>รายละเอียดงาน</th>
                                                    <th>ประเภทงาน</th>
                                                    <th>วันครบกำหนดงาน</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($tasks as $key => $task)
                                                    <tr>
                                                        <td class="text-center">{{ $tasks->firstItem() + $key }}</td>
                                                        <td class="text-center">{{ $task->user->first_name ?? '-' }}</td>
                                                        <td class="text-center">{{ $task->task_name ?? '-' }}</td>
                                                        <td class="text-center">{{ $task->task_detail ?? '-' }}</td>
                                                        <td class="text-center">{{ $task->task_type->type_name ?? '-' }}</td>
                                                        <td class="text-center">{{ \Carbon\Carbon::parse($task->due_date)->translatedFormat('d F Y') }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center text-muted">ไม่มีข้อมูล</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center">
                                            {{ $tasks->links('vendor.livewire.task-paginate') }}
                                        </div>
                                    </div>


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

                            <div class="d-flex flex-column ms-3" style="width: 100%; gap: 15px;">
                                <!-- 🔹 ข้อมูลจำนวนงานแต่ละประเภท -->
                                <div class="p-3 border rounded shadow mb-3" style="background-color: #f8f9fa;">
                                    <h5 class="text-primary fw-bold">จำนวนงานแต่ละประเภทในวันนี้</h5> <!-- ใช้ h4 -->
                                    <ul class="list-unstyled">
                                        @foreach ($taskCountsByType as $type => $count)
                                            <li class="text-lg fw-semibold text-dark">{{ $type }}: {{ $count }} งาน</li>
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- 🔹 ข้อมูลจำนวนงานแต่ละคน -->
                                <div class="p-3 border rounded shadow" style="background-color: #f8f9fa;">
                                    <h5 class="text-primary fw-bold">จำนวนงานของแต่ละประเภทของบุคลากรในวันนี้</h5> <!-- ใช้ h4 -->
                                    <ul class="list-unstyled">
                                        @foreach ($taskCountsByUserAndType as $user => $tasks)
                                            <li class="text-lg fw-semibold text-blue">{{ $user }}:</li>
                                            <ul>
                                                @foreach ($tasks as $task)
                                                    <li class="text-lg text-dark">{{ $task->type_name }}: {{ $task->count }} งาน</li>
                                                @endforeach
                                            </ul>
                                        @endforeach
                                    </ul>
                                </div>
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
        document.addEventListener('DOMContentLoaded', function () {
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
