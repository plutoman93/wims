<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ข้อมูลส่วนตัว</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="https://ui-avatars.com/api/?name={{ $first_name }} {{ $last_name }}"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $title_name }} {{ $first_name }}
                                {{ $last_name }}</h3>

                            <p class="text-muted text-center">{{ $department_name }}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">เกี่ยวกับผู้ใช้</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-phone mr-1"></i> เบอร์มือถือ</strong>

                            <p class="text-muted">
                                {{ $phone }}
                            </p>

                            <hr>

                            <strong><i class="fa fa-address-card mr-1"></i> คณะ</strong>

                            <p class="text-muted">{{ $faculty_name }}</p>

                            <hr>

                            <strong><i class="fa fa-envelope mr-1"></i> อีเมล์</strong>

                            <p class="text-muted">
                                {{ $email }}
                            </p>

                            <hr>

                            <strong><i class="fas fa-user-alt mr-1"></i> ระดับผู้ใช้</strong>

                            <p class="text-muted">
                                {{ $data->status->user_status_name }}
                            </p>

                            <hr>

                            <strong><i class="fas fa-user-circle mr-1"></i> สถานะผู้ใช้</strong>

                            <p class="text-muted">
                                @if ($data->account->account_status_id == '1')
                                    <span class="status-active">{{ $data->account->account_status_name }}</span>
                                @else
                                    <span class="status-inactive">{{ $data->account->account_status_name }}</span>
                                @endif
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
