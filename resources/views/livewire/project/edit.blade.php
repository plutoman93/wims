<div>
    <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Project Edit</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Project Edit</li>
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
                        <label for="inputName">First Name</label>
                        <input type="text" id="inputName1" wire:model="name" class="form-control">
                        @error('name')
                            <span class ="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputName">Last Name</label>
                        <input type="text" id="inputName2" wire:model="last_name" class="form-control">
                        @error('lastname')
                            <span class ="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputName">Phone Number</label>
                        <input type="text" id="inputName3" wire:model="phone_number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Department</label>
                        <select id="inputStatus" wire:model="department" class="form-control custom-select">
                        <option selected >Select one</option>
                        <option value="computer">เทคโนโลยีคอมพิวเตอร์</option>
                        <option value="electric">เทคโนโลยีไฟฟ้า</option>
                        <option value="plant">พืชศาสตร์</option>
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
