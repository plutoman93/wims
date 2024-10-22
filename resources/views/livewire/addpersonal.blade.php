@extends('layouts.backend.master')
@section('content')
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
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputName">ชื่อผู้ใช้</label>
                        <input type="text" id="user_name" wire:model="user_name" class="form-control">
                        @error('task_name')
                            <span class ="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                  <div class="form-group">
                    <label for="inputName">คำนำหน้า</label>
                    <input type="text" id="title_name" wire:model="title_name" class="form-control">
                    @error('task_name')
                        <span class ="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="inputName">ชื่อ</label>
                    <input type="text" id="first_name" wire:model="first_name" class="form-control">
                    @error('task_name')
                        <span class ="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="inputName">นามสกุล</label>
                    <input type="text" id="last_name" wire:model="last_name" class="form-control">
                    @error('task_name')
                        <span class ="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="inputName">อีเมล</label>
                    <input type="text" id="email" wire:model="email" class="form-control">
                    @error('task_name')
                        <span class ="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="inputName">รหัสผ่าน</label>
                    <input type="text" id="password" wire:model="password" class="form-control">
                    @error('task_name')
                        <span class ="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="inputName">สถานะผู้ใช้</label>
                    <input type="text" id="user_status_name" wire:model="user_status_name" class="form-control">
                    @error('task_name')
                        <span class ="text-danger">{{$message}}</span>
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
    @endsection
