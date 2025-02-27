<div>
    <div class="content-wrapper">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0 text-center">จัดการข้อมูลตารางงาน</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <input type="search" class="form-control" placeholder="ค้นหาชื่องาน" wire:model.live="search">
                    </div>
                    @can('can-filter-task')
                        <div class="col-md-4 mb-3">
                            <select class="form-control" wire:model.live="selectedUser">
                                <option value="">เลือกผู้ใช้</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->user_id }}">{{ $user->first_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endcan
                    <div class="col-md-4  mb-3">
                        <select class="form-control" wire:model.live="statusFilter">
                            <option value="">งานทั้งหมด</option>
                            <option value="1">เสร็จสิ้น</option>
                            <option value="2">ยังไม่เสร็จสิ้น</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <select class="form-control" wire:model.live="typeFilter">
                            <option value="">เลือกประเภทงาน</option>
                            @foreach ($taskTypes as $type)
                                <option value="{{ $type->type_id }}">{{ $type->type_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <button class="btn btn-danger" wire:click="confirmDeleteSelectedTasks">ลบงานที่เลือก</button>
                        <a href="{{ route('add-task') }}" class="btn btn-success ml-2">เพิ่มงานใหม่</a>
                        <a href="{{ route('export-tasks', ['selectedUser' => $selectedUser, 'statusFilter' => $statusFilter, 'typeFilter' => $typeFilter]) }}"
                            class="btn btn-primary ml-2">Export เป็น Excel</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-secondary text-white">
                            <tr class="text-center">
                                <th><input type="checkbox" wire:click="toggleSelectAll"></th>
                                <th>ลำดับ</th>
                                <th>เจ้าของงาน</th>
                                <th>ชื่องาน</th>
                                <th>รายละเอียดงาน</th>
                                <th>ประเภทงาน</th>
                                <th>วันเริ่มงาน</th>
                                <th>วันสิ้นสุด</th>
                                <th>สถานะงาน</th>
                                <th>การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $key => $item)
                                <tr>
                                    <td class="text-center"><input type="checkbox" wire:model="selectedTasks"
                                            value="{{ $item->task_id }}"></td>
                                    <td class="text-center">{{ $data->firstItem() + $key }}</td>
                                    <td class="text-center">{{ $item->user->first_name }}</td>
                                    <td class="text-center text-truncate" style="max-width: 200px;">
                                        {{ $item->task_name }}</td>
                                    <td class="text-center text-truncate" style="max-width: 400px;">
                                        {{ $item->task_detail }}</td>
                                    <td class="text-center">{{ $item->task_type->type_name }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->start_date)->addYears(543)->locale('th')->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->due_date)->addYears(543)->locale('th')->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="text-center">
                                        @if ($item->task_status_id == 1)
                                            <button wire:click="taskStatus({{ $item->task_id }}, 2)"
                                                class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @else
                                            <button wire:click="taskStatus({{ $item->task_id }}, 1)"
                                                class="btn btn-uncomplete btn-sm">
                                                <i class="fas fa-hourglass-half"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-warning" href="{{ route('task-edit', ['id' => $item->task_id]) }}">แก้ไข</a>
                                        {{-- ปุ่มลิงก์ไปหน้าแก้ไขงาน --}}
                                        <a class="btn btn-sm btn-danger" wire:click.prevent="delete({{ $item->task_id }})">ลบ</a>
                                        {{-- ปุ่มลบงาน ใช้ Livewire เพื่อเรียกฟังก์ชัน delete --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">ไม่พบข้อมูล</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $data->links('vendor.livewire.task-paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('confirmDelete', event => {
            Swal.fire({
                title: 'คุณแน่ใจใช่มั้ย?',
                text: "คุณต้องการลบงานนี้หรือไม่ ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, ลบเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('deleteTask', event.detail); // เรียก Livewire Method deleteTask
                }
            });
        });

        window.addEventListener('confirmDeleteSelected', event => {
            Swal.fire({
                title: 'คุณแน่ใจใช่มั้ย?',
                text: "คุณต้องการลบงานที่เลือกทั้งหมดหรือไม่ ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, ลบเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('deleteSelectedTasks', event
                        .detail); // เรียก Livewire Method deleteSelectedTasks
                }
            });
        });

        window.addEventListener('alert', event => {
            Swal.fire({
                title: "ลบแล้ว!",
                text: "ลบงานเรียบร้อยแล้ว",
                icon: "success"
            });
        });
    });
</script>
