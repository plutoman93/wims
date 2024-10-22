@extends('layouts.backend.master')
@section('content')
<div>
    <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>บุคลากร</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Personel</li>
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
                  <h3 class="card-title">รายชื่อบุคลากร</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                    <div class="personal">
                        <div class="personal-item">
                          <img src="" alt="">
                          <p>Name</p>
                          <p>Lastname</p>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="personal">
                        <div class="personal-item">
                          <img src="" alt="">
                          <p>Name</p>
                          <p>Lastname</p>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="personal">
                        <div class="personal-item">
                          <img src="" alt="">
                          <p>Name</p>
                          <p>Lastname</p>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="personal">
                        <div class="personal-item">
                          <img src="" alt="">
                          <p>Name</p>
                          <p>Lastname</p>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="personal">
                        <div class="personal-item">
                          <img src="" alt="">
                          <p>Name</p>
                          <p>Lastname</p>
                        </div>
                    </div>
                  </div>


                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          </form>
    </section>

        <!-- /.content -->
      </div>
    </div>
    @endsection
