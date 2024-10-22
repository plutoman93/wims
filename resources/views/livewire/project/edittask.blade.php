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
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                        <label for="inputName">Task Name</label>
                        <input type="text" id="inputName1" wire:model="task_name" class="form-control">
                        @error('task_name')
                            <span class ="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputName">Task Detail</label>
                        <input type="text" id="inputName2" wire:model="task_detail" class="form-control">
                        @error('task_detail')
                            <span class ="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputName">Start Date</label>
                        <input type="date" id="inputName3" wire:model="task_start_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputName">Due Date</label>
                        <input type="date" id="inputName3" wire:model="task_due_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Task Type</label>
                        <select id="inputStatus" wire:model="task_type" class="form-control custom-select">
                        <option selected >Select one</option>
                        <option value="computer">ประชุม</option>
                        <option value="electric">ลาป่วย</option>
                        <option value="plant">ไปราชการ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Status</label>
                        <select id="inputStatus" wire:model="status_task" class="form-control custom-select">
                        <option selected >Select one</option>
                        <option value="computer">เสร็จ</option>
                        <option value="electric">ยังไม่เสร็จ</option>
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
