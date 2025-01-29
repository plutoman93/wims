<div>
    <div class="content-wrapper">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">ตารางงาน</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="search" class="form-control" placeholder="ค้นหา" wire:model.live="search">
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
                            @forelse ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $item->task_id }}</td>
                                    <td class="text-center">{{ $item->task_name }}</td>
                                    <td class="text-center">{{ $item->task_detail }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->due_date)->format('d-m-Y') }}</td>
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
                                            wire:click="delete({{ $item->task_id }})">ลบ</a>
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
