<div>
    <div class="content-wrapper">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">สรุปตารางงาน</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    @can('can-filter-task')
                        <div class="col-md-4 mb-3">
                            <select class="form-control" wire:model="selectedUser">
                                <option value="">เลือกผู้ใช้</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->user_id }}">{{ $user->first_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endcan
                    <div class="col-md-4 mb-3">
                        <select class="form-control" wire:model="dateFilter">
                            <option value="">เลือกวันที่</option>
                            @foreach ($dates as $date)
                                <option value="{{ $date }}">{{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <select class="form-control" wire:model="typeFilter">
                            <option value="">เลือกประเภทงาน</option>
                            @foreach ($taskTypes as $type)
                                <option value="{{ $type->type_id }}">{{ $type->type_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-between my-3">
                    <button class="btn btn-secondary" wire:click="prevDate" @if($dateFilter == $dates->first()) disabled @endif>ก่อนหน้า</button>
                    <span class="fw-bold">
                        วันที่ {{ \Carbon\Carbon::parse($dateFilter)->translatedFormat('d F') }} {{ \Carbon\Carbon::parse($dateFilter)->format('Y') }}
                    </span>
                    <button class="btn btn-secondary" wire:click="nextDate" @if($dateFilter == $dates->last()) disabled @endif>ถัดไป</button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-secondary text-white">
                            <tr class="text-center">
                                <th>ลำดับ</th>
                                <th>เจ้าของงาน</th>
                                <th>ชื่องาน</th>
                                <th>ประเภทงาน</th>
                                <th>วันเริ่มต้นงาน</th>
                                <th>วันครบกำหนดงาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $key => $task)
                                <tr>
                                    <td class="text-center">{{ $tasks->firstItem() + $key }}</td>
                                    <td class="text-center">{{ $task->user->first_name ?? '-' }}</td>
                                    <td class="text-center">{{ $task->task_name ?? '-' }}</td>
                                    <td class="text-center">{{ $task->task_type->type_name ?? '-' }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($task->start_date)->translatedFormat('d F Y') }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($task->due_date)->translatedFormat('d F Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">ไม่มีข้อมูล</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
