@extends('layouts.backend.master')
@section('content')
<div>
    <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Add Task</h1>
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
        <!-- Change form action to the appropriate route -->
        <form action="{{ route('addtask') }}" method="POST" enctype="multipart/form-data>
            @csrf
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
                    <input type="text" id="inputName" name="task_name" class="form-control" value="{{ old('task_name') }}">
                    @error('task_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="inputDetail">Task Detail</label>
                    <input type="text" id="inputDetail" name="task_detail" class="form-control" value="{{ old('task_detail') }}">
                    @error('task_detail')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="inputStartDate">Start Date</label>
                    <input type="date" id="inputStartDate" name="start_date" class="form-control" value="{{ old('start_date') }}">
                  </div>
                  <div class="form-group">
                    <label for="inputDueDate">Due Date</label>
                    <input type="date" id="inputDueDate" name="due_date" class="form-control" value="{{ old('due_date') }}">
                  </div>
                  <div class="form-group">
                    <label for="inputFile">File</label>
                    <input type="file" id="inputFile" name="task_file" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="inputType">Task Type</label>
                    <select id="inputType" name="type" class="form-control custom-select">
                      <option selected>Select one</option>
                      <option value="ประชุม" {{ old('type') == 'ประชุม' ? 'selected' : '' }}>ประชุม</option>
                      <option value="ลาป่วย" {{ old('type') == 'ลาป่วย' ? 'selected' : '' }}>ลาป่วย</option>
                      <option value="ไปราชการ" {{ old('type') == 'ไปราชการ' ? 'selected' : '' }}>ไปราชการ</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="inputStatus">Status</label>
                    <select id="inputStatus" name="task_status" class="form-control custom-select">
                      <option selected>Select one</option>
                      <option value="เสร็จ" {{ old('task_status') == 'เสร็จ' ? 'selected' : '' }}>เสร็จ</option>
                      <option value="ยังไม่เสร็จ" {{ old('task_status') == 'ยังไม่เสร็จ' ? 'selected' : '' }}>ยังไม่เสร็จ</option>
                    </select>
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
              <button type="submit" class="btn btn-success">Add</button>
            </div>
          </div>
          </form>
    </section>

        <!-- /.content -->
      </div>
    </div>
@endsection
