@extends('layouts.backend.master')
@section('content')
<div>
    <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>จัดการระบบ</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a>Home</a></li>
                  <li class="breadcrumb-item active">System Setting</li>
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
                  <h3 class="card-title">จัดการระบบ</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputName">เพิ่มคำนำหน้า</label>
                    <input type="text" id="title_name" wire:model="title_name" class="form-control">
                    @error('title_name')
                        <span class ="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="inputName">เพิ่มสาขา</label>
                    <input type="text" id="department_name" wire:model="department_name" class="form-control">
                    @error('department_name')
                        <span class ="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="inputName">เพิ่มคณะ</label>
                    <input type="text" id="facuty_name" wire:model="faculty_name" class="form-control">
                    @error('faculty_name')
                        <span class ="text-danger">{{$message}}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="inputName">กำหนดเวลาแจ้งเตือน</label>
                    <input type="text" id="facuty_name" wire:model="faculty_name" class="form-control">
                    @error('faculty_name')
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
