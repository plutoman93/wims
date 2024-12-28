<div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">แก้ไขข้อมูลบุคลากร</li>
                        </ol>
                    </div>
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
                            <div class="card-header">
                                <h3 class="card-title">General</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputStatus">เลือกคำนำหน้า</label>
                                    <select id="inputStatus" wire:model="faculty_name" class="form-control custom-select">
                                        <option value="">เลือกคำนำหน้า</option>
                                        <option value="นาย">นาย</option>
                                        <option value="นาง">นาง</option>
                                        <option value="นางสาว">นางสาว</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">ชื่อ</label>
                                    <input type="text" id="inputName1" wire:model="first_name" class="form-control">
                                    @error('first_name')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputName">นามสกุล</label>
                                    <input type="text" id="inputName2" wire:model="last_name" class="form-control">
                                    @error('last_name')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputName">เบอร์มือถือ</label>
                                    <input type="text" id="inputName3" wire:model="phone" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">คณะ</label>
                                    <select id="inputStatus" wire:model="faculty_name" class="form-control custom-select">
                                        <option selected>Select one</option>
                                        <option value="เกษตรศาสตร์และเทคโนโลยี">เกษตรศาสตร์และเทคโนโลยี</option>
                                        <option value="เทคโนโลยีการจัดการ">เทคโนโลยีการจัดการ</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">สาขาวิชา</label>
                                    <select id="inputStatus" wire:model="department_name" class="form-control custom-select">
                                        <option selected>Select one</option>
                                        <option value="วิทยาการคอมพิวเตอร์">วิทยาการคอมพิวเตอร์</option>
                                        <option value="เทคนิคคอมพิวเตอร์">เทคนิคคอมพิวเตอร์</option>
                                        <option value="เทคโนโลยีคอมพิวเตอร์">เทคโนโลยีคอมพิวเตอร์</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Email</label>
                                    <input type="email" id="inputName4" wire:model="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Password</label>
                                    <input type="password" id="inputName5" wire:model="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Photo</label>
                                    <input type="file" id="inputName6" wire:model="photo" class="form-control">
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="#" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success floar-right ">Edit</button>
                    </div>
                </div>
            </form>
        </section>

        <!-- /.content -->
    </div>
</div>
