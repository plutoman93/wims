<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ข้อมูลส่วนตัว</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Profile Section -->
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="https://ui-avatars.com/api/?name={{ $first_name }} {{ $last_name }}"
                                alt="User profile picture">
                            <h3 class="profile-username">{{ $title_name }} {{ $first_name }} {{ $last_name }}
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- User Info Section -->
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header bg-dark">
                            <h3 class="card-title">เกี่ยวกับผู้ใช้</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong><i class="fa fa-envelope mr-1"></i> อีเมล</strong>
                                    <p class="text-muted">{{ $email }}</p>
                                    <hr>
                                    <strong><i class="fa fa-address-card mr-1"></i> คณะ</strong>
                                    <p class="text-muted">{{ $faculty_name }}</p>
                                    <hr>
                                    <strong><i class="fa fa-address-card mr-1"></i> สาขา</strong>
                                    <p class="text-muted">{{ $department_name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong><i class="fas fa-phone mr-1"></i> เบอร์มือถือ</strong>
                                    <p class="text-muted">{{ $phone }}</p>
                                    <hr>
                                    <strong><i class="fas fa-user-alt mr-1"></i> ระดับผู้ใช้</strong>
                                    <p class="text-muted">{{ $data->status->user_status_name }}</p>
                                    <hr>
                                    <strong><i class="fas fa-user-circle mr-1"></i> สถานะผู้ใช้</strong>
                                    <p class="text-muted">
                                        @if ($data->account->account_status_id == '1')
                                            <span
                                                class="status-active">{{ $data->account->account_status_name }}</span>
                                        @else
                                            <span
                                                class="status-inactive">{{ $data->account->account_status_name }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
