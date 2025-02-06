<div>
    <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Edit Task</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a>Home</a></li>
                  <li class="breadcrumb-item active">Edit Task</li>
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
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    </div>
                    <div class="card-body">
                    <div class="form-group">
                        <label for="inputName">ชื่องาน</label>
                        <input type="text" id="inputName1" wire:model="task_name" class="form-control">
                        @error('task_name')
                            <span class ="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputName">รายละเอียดงาน</label>
                        <input type="text" id="inputName2" wire:model="task_detail" class="form-control">
                        @error('task_detail')
                            <span class ="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputName">วันเริ่มที่เริ่มต้น</label>
                        <input type="date" id="inputName3" wire:model="start_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputName">วันที่เสร็จสิ้น</label>
                        <input type="date" id="inputName3" wire:model="due_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">ชนิดงาน</label>
                        <select id="inputStatus" wire:model="type_id" class="form-control custom-select">
                        <option value="" >เลือกชนิดงาน</option>
                        <option value="1">ปฏิบัติราชการ</option>
                        <option value="2">ลากิจ</option>
                        <option value="3">ประชุม</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">สถานะงาน</label>
                        <select id="inputStatus" wire:model="task_status_id" class="form-control custom-select">
                        <option value="" >เลือกสถานะงาน</option>
                        <option value="1">เสร็จ</option>
                        <option value="2">ยังไม่เสร็จ</option>
                        </select>
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
