<div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>เพิ่มบุคลากร</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Personal</li>
                        </ol>
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
                            <div class="card-header">
                                <h3 class="card-title">จัดการการเพิ่มบุคลากร</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">ชื่อผู้ใช้</label>
                                    <input type="text" id="username" wire:model="username" class="form-control">
                                    @error('username')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputTitle">คำนำหน้า</label>
                                    <select id="inputTitle" wire:model="title_name" class="form-control custom-select">
                                        <option selected>Select one</option>
                                        @foreach($titles as $title)
                                            <option value="{{ $title->title_name }}">{{ $title->title_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('title_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputName">ชื่อ</label>
                                    <input type="text" id="first_name" wire:model="first_name" class="form-control">
                                    @error('first_name')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputName">นามสกุล</label>
                                    <input type="text" id="last_name" wire:model="last_name" class="form-control">
                                    @error('last_name')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputName">เบอร์มือถือ</label>
                                    <input type="text" id="phone" wire:model="phone" class="form-control">
                                    @error('phone')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">คณะ</label>
                                    <select id="inputStatus" wire:model="faculty_name"
                                        class="form-control custom-select">
                                        <option selected>Select one</option>
                                        <option value="เกษตรศาสตร์และเทคโนโลยี">เกษตรศาสตร์และเทคโนโลยี</option>
                                        <option value="เทคโนโลยีการจัดการ">เทคโนโลยีการจัดการ</option>
                                        @error('faculty_name')
                                            <span class ="text-danger">{{ $message }}</span>
                                        @enderror
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">สาขา</label>
                                    <select id="inputStatus" wire:model="department_name"
                                        class="form-control custom-select">
                                        <option selected>Select one</option>
                                        <option value="วิทยาการคอมพิวเตอร์">วิทยาการคอมพิวเตอร์</option>
                                        <option value="เทคโนโลยีคอมพิวเตอร์">เทคโนโลยีคอมพิวเตอร์</option>
                                        <option value="เทคนิคคอมพิวเตอร์">เทคนิคคอมพิวเตอร์</option>
                                        @error('department_name')
                                            <span class ="text-danger">{{ $message }}</span>
                                        @enderror
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="inputName">อีเมล</label>
                                    <input type="text" id="email" wire:model="email" class="form-control">
                                    @error('email')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">ระดับผู้ใช้</label>
                                    <select id="inputStatus" wire:model="user_status_name" class="form-control custom-select">
                                        <option selected>เลือกระดับผู้ใช้</option>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->user_status_name }}">{{ $status->user_status_name }}</option>
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
                        <a href="#" class="btn btn-secondary">ยกเลิก</a>
                        <button type="submit" class="btn btn-success ">เพิ่ม</button>
                    </div>
                </div>
            </form>
        </section>

        <!-- /.content -->
    </div>
</div>
