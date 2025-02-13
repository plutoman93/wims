<div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>เพิ่มบุคลากร</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form wire:submit.prevent="add">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header bg-dark">
                                <h3 class="card-title">กรอกข้อมูลเพิ่มบุคลากร</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">ชื่อผู้ใช้</label>
                                    <input type="text" id="username" wire:model="username" class="form-control"
                                        placeholder="กรอกชื่อผู้ใช้">
                                    @error('username')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputTitle">คำนำหน้า</label>
                                    <select id="inputTitle" wire:model="title_name" class="form-control custom-select">
                                        <option selected>Select one</option>
                                        @foreach ($titles as $title)
                                            <option value="{{ $title->title_name }}">{{ $title->title_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('title_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputName">ชื่อ</label>
                                    <input type="text" id="first_name" wire:model="first_name" class="form-control"
                                        placeholder="กรอกชื่อ">
                                    @error('first_name')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputName">นามสกุล</label>
                                    <input type="text" id="last_name" wire:model="last_name" class="form-control"
                                        placeholder="กรอกนามสกุล">
                                    @error('last_name')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputName">เบอร์มือถือ</label>
                                    <input type="text" id="phone" wire:model="phone" class="form-control"
                                        placeholder="กรอกเบอร์มือถือ">
                                    @error('phone')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="faculty_name">คณะ</label>
                                        <select id="faculty_name" wire:model="faculty_name"
                                            class="form-control custom-select">
                                            <option selected>กรุณาเลือกคณะ</option>
                                            <option value="เกษตรศาสตร์และเทคโนโลยี">เกษตรศาสตร์และเทคโนโลยี</option>
                                            <option value="เทคโนโลยีการจัดการ">เทคโนโลยีการจัดการ</option>
                                        </select>
                                        @error('faculty_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="department_name">สาขา</label>
                                        <select id="department_name" wire:model="department_name"
                                            class="form-control custom-select">
                                            <option selected>กรุณาเลือกสาขา</option>
                                            <option value="วิทยาการคอมพิวเตอร์">วิทยาการคอมพิวเตอร์</option>
                                            <option value="เทคโนโลยีคอมพิวเตอร์">เทคโนโลยีคอมพิวเตอร์</option>
                                        </select>
                                        @error('department_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName">อีเมล์</label>
                                    <input type="text" id="email" wire:model="email" class="form-control"
                                        placeholder="กรอกอีเมล์">
                                    @error('email')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">ระดับผู้ใช้</label>
                                    <select id="inputStatus" wire:model="user_status_name"
                                        class="form-control custom-select">
                                        <option selected>เลือกระดับผู้ใช้</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->user_status_name }}">
                                                {{ $status->user_status_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_status_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputName">รหัสผ่าน</label>
                                    <input type="password" id="password" wire:model="password" class="form-control">
                                    @error('password')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success ">เพิ่ม</button>
                        <button type="button" class="btn btn-danger" wire:click="resetForm">ยกเลิก</button>
                    </div>
                </div>
            </form>
        </section>

        <!-- /.content -->
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('input[placeholder], select[placeholder]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.dataset.placeholder = this.placeholder;
                this.placeholder = '';
            });
            input.addEventListener('blur', function() {
                this.placeholder = this.dataset.placeholder;
            });
        });
    });
</script>
