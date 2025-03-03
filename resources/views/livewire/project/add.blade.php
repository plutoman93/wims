<div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0 text-center">เพิ่มข้อมูลงาน</h4>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form wire:submit.prevent="add">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="task_name">ชื่องาน</label>
                                        <input type="text" id="task_name" wire:model="task_name" class="form-control"
                                            placeholder="กรอกชื่องาน">
                                        @error('task_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($isAdmin)
                                        <div class="form-group col-md-6">
                                            <label for="user_id">มอบหมายให้</label>
                                            <select wire:model="user_id" class="form-control">
                                                <option value="">{{ Auth::user()->first_name }}</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->user_id }}">{{ $user->first_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="task_detail">รายละเอียดงาน</label>
                                    <textarea id="task_detail" wire:model="task_detail" class="form-control" placeholder="กรอกรายละเอียดงาน"></textarea>
                                    @error('task_detail')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="start_date">วันที่เริ่มต้น</label>
                                        <div class="flatpickr-wrapper">
                                            <input type="date" id="start_date" wire:model="start_date"
                                                class="form-control flatpickr" placeholder="วัน/เดือน/ปี">
                                            @error('start_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="due_date">วันที่เสร็จสิ้น</label>
                                        <div class="flatpickr-wrapper">
                                            <input type="date" id="due_date" wire:model="due_date"
                                                class="form-control flatpickr" placeholder="วัน/เดือน/ปี">
                                            @error('due_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="type_id">ประเภทงาน</label>
                                    <select id="inputStatus" wire:model="type_id" class="form-control custom-select">
                                        <option value="">เลือกประเภทงาน</option>
                                        @foreach ($task_types as $type)
                                            <option value="{{ $type->type_id }}">{{ $type->type_name }}</option>
                                        @endforeach
                                        {{-- <option value="other">อื่นๆ</option> --}}
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
                        <button type="submit" class="btn btn-success">เพิ่ม</button>
                        <button type="button" class="btn btn-danger" wire:click="resetForm">ยกเลิก</button>
                    </div>
                </div>
            </form>
        </section>
        <!-- /.content -->
    </div>
</div>
