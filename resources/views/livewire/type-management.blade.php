<div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2>จัดการประเภทงาน</h2>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}">
                    <div class="form-group">
                        <label for="type_name">ชื่อประเภทงาน</label>
                        <input type="text" class="form-control" id="type_name" wire:model="type_name">
                        @error('type_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{ $isEditMode ? 'แก้ไข' : 'เพิ่ม' }}</button>
                    @if ($isEditMode)
                        <button type="button" class="btn btn-secondary" wire:click="resetInputFields">ยกเลิก</button>
                    @endif
                </form>
            </div>
            <div class="col-md-6">
                <h2>รายการประเภทงาน</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ชื่อประเภทงาน</th>
                            <th>การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($task_types as $type)
                            <tr>
                                <td>{{ $type->type_name }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm"
                                        wire:click="edit({{ $type->type_id }})">แก้ไข</button>
                                    <button class="btn btn-danger btn-sm"
                                        wire:click.prevent="delete({{ $type->type_id }})">ลบ</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $task_types->links() }}
            </div>
        </div>
    </div>
</div>
