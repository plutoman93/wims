<div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>จัดการการเพิ่มข้อมูลงาน</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Task</li>
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
                                <h3 class="card-title">จัดการการเพิ่มข้อมูลงาน</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Task Name</label>
                                    <input type="text" id="task_name" wire:model="task_name" class="form-control">
                                    @error('task_name')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Task Detail</label>
                                    <input type="text" id="task_detail" wire:model="task_detail"
                                        class="form-control">
                                    @error('task_detail')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Start Date</label>
                                    <input type="date" id="start_date" wire:model="start_date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Due Date</label>
                                    <input type="date" id="due_date" wire:model="due_date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">File</label>
                                    <input type="file" id="inputName" wire:model="task_file" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Task Type</label>
                                    <select id="inputStatus" wire:model="task_type" class="form-control custom-select">
                                        <option selected>Select one</option>
                                        <option value="ประชุม">ประชุม</option>
                                        <option value="ลาป่วย">ลาป่วย</option>
                                        <option value="ไปราชการ">ไปราชการ</option>
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="inputStatus">Status</label>
                                    <select id="inputStatus" wire:model="status_task"
                                        class="form-control custom-select">
                                        <option selected>Select one</option> //ปิดฟอร์ม สภานะงานเพราะอาจไม่ตรงกับโครงสร้างฟอร์มและการเก็บข้อมูล ?
                                        <option value="เสร็จ">เสร็จ</option>
                                        <option value="ยังไม่เสร็จ">ยังไม่เสร็จ</option>
                                    </select>
                                </div> --}}
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
