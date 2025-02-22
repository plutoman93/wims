<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>จัดการข้อมูลบัญชี</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->

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
                                        src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->first_name . ' ' . auth()->user()->last_name) }}"
                                        alt="User profile picture">
                                </div>

                                {{-- <h3 class="profile-username text-center">{{ $first_name }} {{ $last_name }}</h3> --}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <!-- ซ่อนแท็บเมนู -->
                                <ul class="nav nav-pills" style="display: none;">
                                    <li class="nav-item"><a class="nav-link" href="#settings"
                                            data-toggle="tab">จัดการข้อมูลบัญชี</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- เพิ่ม class "active" เพื่อให้เนื้อหาแสดงตั้งแต่แรก -->
                                    <div class="tab-pane active" id="settings">
                                        <form wire:submit.prevent="updateProfile" class="form-horizontal">
                                            <div>
                                                @if (session()->has('message'))
                                                    <div class="alert alert-success">
                                                        {{ session('message') }}
                                                    </div>
                                                @elseif (session()->has('error'))
                                                    <div class="alert alert-error">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputTitle" class="col-sm-2 col-form-label">คำนำหน้า</label>
                                                <div class="col-sm-10">
                                                    <select wire:model="title_id" class="form-control" id="inputTitle">
                                                        <option value="">เลือกคำนำหน้า</option>
                                                        <option value="1">นาย</option>
                                                        <option value="2">นาง</option>
                                                        <option value="3">นางสาว</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">ชื่อ</label>
                                                <div class="col-sm-10">
                                                    <input type="text" wire:model="first_name" class="form-control"
                                                        id="inputName" placeholder="ชื่อ">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputLastName"
                                                    class="col-sm-2 col-form-label">นามสกุล</label>
                                                <div class="col-sm-10">
                                                    <input type="text" wire:model="last_name" class="form-control"
                                                        id="inputLastName" placeholder="นามสกุล">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPhoneNumber"
                                                    class="col-sm-2 col-form-label">เบอร์มือถือ</label>
                                                <div class="col-sm-10">
                                                    <input type="number" wire:model="phone" class="form-control"
                                                        id="inputPhoneNumber" placeholder="เบอร์มือถือ">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputFaculty" class="col-sm-2 col-form-label">คณะ</label>
                                                <div class="col-sm-10">
                                                    <select wire:model="faculty_id" class="form-control"
                                                        wire:change="updateDepartments($event.target.value)"
                                                        id="inputFaculty">
                                                        <option value="">เลือกคณะ</option>
                                                        @foreach ($faculties as $faculty)
                                                            <option value="{{ $faculty->faculty_id }}">
                                                                {{ $faculty->faculty_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputDepartment"
                                                    class="col-sm-2 col-form-label">สาขาวิชา</label>
                                                <div class="col-sm-10">
                                                    <select wire:model="department_id" class="form-control"
                                                        id="inputDepartment">
                                                        <option value="">เลือกสาขา</option>
                                                        @foreach ($departments as $department)
                                                            <option value="{{ $department->department_id }}">
                                                                {{ $department->department_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">อีเมล</label>
                                                <div class="col-sm-10">
                                                    <input type="email" wire:model="email" class="form-control"
                                                        id="inputEmail" placeholder="อีเมล">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputUserName" class="col-sm-2 col-form-label">ชื่อผู้ใช้</label>
                                                <div class="col-sm-10">
                                                    <input type="text" wire:model="username" class="form-control" id="inputUsername" placeholder="ชื่อผู้ใช้" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputPassword"
                                                    class="col-sm-2 col-form-label">รหัสผ่าน</label>
                                                <div class="col-sm-10">
                                                    <input type="password" wire:model="password" class="form-control"
                                                        id="inputPassword" placeholder="รหัสผ่าน">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-success">บันทึก</button>
                                                    <button type="button" class="btn btn-danger"
                                                        wire:click="resetForm">ยกเลิก</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
        </section>
    </section>
</div>
