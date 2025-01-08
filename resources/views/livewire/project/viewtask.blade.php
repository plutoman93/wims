<div>
    <div class="content-wrapper">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">ตารางงาน</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="ค้นหา" wire:model.debounce.300ms="search">
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $data->firstItem() + $index }}</td>
                                    <td class="text-center">{{ $item->task_name }}</td>
                                    <td class="text-center">{{ $item->task_detail }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }}
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->due_date)->format('d-m-Y') }}
                                    </td>
                                    <td>
                                        <span class="text-center badge
                                            {{ $item->task_status && $item->task_status->task_status_name === 'เสร็จสิ้น' ? 'bg-success text-white' : ($item->task_status ? 'bg-danger text-white' : 'bg-secondary text-white') }}">
                                            {{ $item->task_status->task_status_name ?? 'ไม่พบสถานะ' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-warning"
                                            href="{{ route('task-edit', ['id' => $item->task_id]) }}">
                                            แก้ไข
                                        </a>
                                        <a class="btn btn-sm btn-danger" wire:click="delete({{ $item->task_id }})">
                                            ลบ
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">ไม่พบข้อมูล</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $data->links() }} <!-- Pagination -->
                </div>
            </div>
        </div>
    </div>
</div>
