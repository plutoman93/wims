<div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0 text-center">แก้ไขข้อมูลบุคลากร</h4>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        {{-- @dd(555) --}}
        <!-- Main content -->
        <section class="content">
            <form wire:submit.prevent="edit">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="input_first_name">ชื่อผู้ใช้</label>
                                    <input type="text" id="username" wire:model="username" class="form-control">
                                    @error('username')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="input_title">เลือกคำนำหน้า</label>
                                    <select id="title" wire:model="title_id" class="form-control custom-select">
                                        <option value="">เลือกคำนำหน้า</option>
                                        <option value="1">นาย</option>
                                        <option value="2">นาง</option>
                                        <option value="3">นางสาว</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="input_first_name">ชื่อ</label>
                                    <input type="text" id="first_name" wire:model="first_name" class="form-control">
                                    @error('first_name')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="input_last_name">นามสกุล</label>
                                    <input type="text" id="last_name" wire:model="last_name" class="form-control">
                                    @error('last_name')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="input_number">เบอร์มือถือ</label>
                                    <input type="text" id="phone" wire:model="phone" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="input_faculty">คณะ</label>
                                    <select id="faculty" wire:model="faculty_id" class="form-control custom-select"
                                        wire:change="updateDepartments($event.target.value)">
                                        <option value="">เลือกคณะ</option>
                                        <@foreach ($faculties as $faculty)
                                            <option value="{{ $faculty->faculty_id }}"> {{-- Use faculty_id as value --}}
                                                {{ $faculty->faculty_name }}
                                            </option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="input_department">สาขาวิชา</label>
                                    <select id="department" wire:model="department_id"
                                        class="form-control custom-select">
                                        <option value="">เลือกสาขา</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->department_id }}">
                                                {{ $department->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="input_email">อีเมล</label>
                                    <input type="email" id="email" wire:model="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="input_password">รหัสผ่าน</label>
                                    <input type="password" id="password" wire:model="password" class="form-control">
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success floar-right ">แก้ไข</button>
                        <button type="button" class="btn btn-danger" wire:click="resetForm">ยกเลิก</button>
                    </div>
                </div>
            </form>
        </section>

        <!-- /.content -->
    </div>
</div>
