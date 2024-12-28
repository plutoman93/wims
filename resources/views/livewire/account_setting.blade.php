<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>จัดการข้อมูลบัญชี</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
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
                                    <img class="profile-user-img img-fluid img-circle" {{-- src="{{ asset('storage') }}/{{ auth()->user()->photo }}" --}}
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
                                                <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
                                                <div class="col-sm-10">
                                                    <select wire:model="title_name" class="form-control" id="inputTitle">
                                                        <option value="">เลือกคำนำหน้า</option>
                                                        <option value="นาย">นาย</option>
                                                        <option value="นาง">นาง</option>
                                                        <option value="นางสาว">นางสาว</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">First Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" wire:model="first_name" class="form-control"
                                                        id="inputName" placeholder="ชื่อ">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputLastName" class="col-sm-2 col-form-label">Last Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" wire:model="last_name" class="form-control"
                                                        id="inputLastName" placeholder="นามสกุล">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputDepartment" class="col-sm-2 col-form-label">Department</label>
                                                <div class="col-sm-10">
                                                    <select wire:model="department_name" class="form-control" id="inputDepartment">
                                                        <option value="">เลือกสาขา</option>
                                                        <option value="วิทยาการคอมพิวเตอร์">วิทยาการคอมพิวเตอร์</option>
                                                        <option value="เทคโนโลยีคอมพิวเตอร์">เทคโนโลยีคอมพิวเตอร์</option>
                                                        <option value="เทคนิคคอมพิวเตอร์">เทคนิคคอมพิวเตอร์</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputFaculty" class="col-sm-2 col-form-label">Faculty</label>
                                                <div class="col-sm-10">
                                                    <select wire:model="faculty_name" class="form-control" id="inputFaculty">
                                                        <option value="">เลือกคณะ</option>
                                                        <option value="เกษตรศาสตร์และเทคโนโลยี">เกษตรศาสตร์และเทคโนโลยี</option>
                                                        <option value="เทคโนโลยีการจัดการ">เทคโนโลยีการจัดการ</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPhoto" class="col-sm-2 col-form-label">Image</label>
                                                <div class="col-sm-10">
                                                    <input type="file" wire:model="photo" class="form-control"
                                                        id="inputPhoto" placeholder="Image">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">บันทึก</button>
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
