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
                    <h1 class="h3 mb-0 text-gray-800">ยินดีต้อนรับ {{ Auth::user()->username }}</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            งานทั้งหมด</div>
                                        <h1 style="text-align: center;"> {{ $count }}</h1>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            งานที่เสร็จแล้ว</div>
                                        <h1 style="text-align: center;"> {{ $countCompleted }}</h1>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            งานที่กำลังทำ</div>
                                        <h1 style="text-align: center;">{{ $countUncompleted }}</h1>

                                        <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->

                <div class="row">
                    <!-- Area Chart -->
                    <div class="col-xl-8 col-lg-7">
                        <div class="card shadow mb-4">
                            <!-- Card Header -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">จำนวนงานของบุคลากร</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="row">
                                @if (!empty($users) && count($users) > 0)
                                    @foreach($users as $user)
                                        <div class="col-md-4 mb-4">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                                {{ $user->name }}
                                                            </div>
                                                            <h1 style="text-align: center;">{{ $user->tasks_count }}</h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-center text-muted">ไม่มีข้อมูลผู้ใช้</p>
                                @endif
                            </div>


                        </div>
                    </div>
                    <!-- Bar Chart -->
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">จำนวนงานแต่ละประเภท</h6>
                            </div>

                            <div class="card-body">
                                <!-- กล่องงานที่กำลังทำ -->
                                <div class="card border-left-warning shadow h-100 py-2 mb-4">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    ปฏิบัติราชการ
                                                </div>
                                                <h1 class="text-center">{{ $tasktype1 }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- กล่องงานที่เสร็จแล้ว -->
                                <div class="card border-left-success shadow h-100 py-2 mb-4">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    ลากิจ
                                                </div>
                                                <h1 class="text-center">{{ $tasktype2 }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- กล่องงานที่รอดำเนินการ -->
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    ประชุม
                                                </div>
                                                <h1 class="text-center">{{ $tasktype3 }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


            </section>

            <!-- /.content -->
        </div>
    </div>
@endsection
