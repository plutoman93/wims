<div>
    <div class="content-wrapper">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0 text-center">จัดการข้อมูลตารางงาน</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="search" class="form-control" placeholder="ค้นหา" wire:model.live="search">
                    </div>
                    @can('can-filter-task')
                        <div class="col-md-4">
                            <select class="form-control" wire:model.live="selectedUser">
                                <option value="">เลือกผู้ใช้</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->user_id }}">{{ $user->username }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endcan
                    <div class="col-md-4">
                        <select class="form-control" wire:model.live="statusFilter">
                            <option value="">งานทั้งหมด</option>
                            <option value="1">เสร็จสิ้น</option>
                            <option value="2">ยังไม่เสร็จสิ้น</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-secondary text-white">
                            <tr class="text-center">
                                <th>ลำดับ</th>
                                <th>ชื่องาน</th>
                                <th>รายละเอียดงาน</th>
                                <th>วันเริ่มงาน</th>
                                <th>วันครบกำหนดงาน</th>
                                <th>สถานะงาน</th>
                                <th>การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $data->firstItem() + $key }}</td>
                                    <td class="text-center text-truncate" style="max-width: 200px;">{{ $item->task_name }}</td>
                                    <td class="text-center text-truncate" style="max-width: 400px;">{{ $item->task_detail }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->start_date)->addYears(543)->translatedFormat('d-M-Y') }}
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->due_date)->addYears(543)->translatedFormat('d-M-Y') }}
                                    </td>
                                    <td class="text-center">
                                        @if ($item->task_status_id == 1)
                                            <button wire:click="taskStatus({{ $item->task_id }}, 2)"
                                                class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @else
                                            <button wire:click="taskStatus({{ $item->task_id }}, 1)"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-warning"
                                            href="{{ route('task-edit', ['id' => $item->task_id]) }}">แก้ไข</a>
                                        <a class="btn btn-sm btn-danger"
                                            wire:click.prevent="delete({{ $item->task_id }})">ลบ</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">ไม่พบข้อมูล</td>
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

        window.addEventListener('alert', event => {
            Swal.fire({
                title: "ลบแล้ว!",
                text: "ลบงานเรียบร้อยแล้ว",
                icon: "success"
            });
        });
    });
</script>
