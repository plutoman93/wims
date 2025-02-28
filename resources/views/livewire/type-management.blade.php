<div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <!-- ส่วนฟอร์มเพิ่ม/แก้ไขประเภทงาน -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-tasks"></i> จัดการประเภทงาน</h5>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}">
                            <div class="form-group">
                                <label for="type_name" class="font-weight-bold">ชื่อประเภทงาน</label>
                                <input type="text" class="form-control" id="type_name" wire:model="type_name"
                                    placeholder="กรอกชื่อประเภทงาน...">
                                @error('type_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> {{ $isEditMode ? 'แก้ไข' : 'เพิ่ม' }}
                                </button>
                                @if ($isEditMode)
                                    <button type="button" class="btn btn-secondary" wire:click="resetInputFields">
                                        <i class="fas fa-times"></i> ยกเลิก
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ส่วนแสดงรายการประเภทงาน -->
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-list"></i> รายการประเภทงาน</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ชื่อประเภทงาน</th>
                                    <th class="text-center">การจัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($task_types as $type)
                                    <tr>
                                        <td>{{ $type->type_name }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-warning btn-sm"
                                                wire:click="edit({{ $type->type_id }})">
                                                <i class="fas fa-edit"></i> แก้ไข
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $task_types->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
