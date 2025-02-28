<!-- filepath: /d:/laragon/www/wims/resources/views/livewire/summary-schedule.blade.php -->
<div>
    <div class="col-xl-20 col-lg-20" class="content-wrapper">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">สรุปตารางงาน</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
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

                    <div class="col-md-4 mb-3">
                        <input type="date" class="form-control" wire:model.live="startDate"
                            placeholder="เลือกวันที่เริ่มต้น">
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="date" class="form-control" wire:model.live="endDate"
                            placeholder="เลือกวันที่สิ้นสุด">
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between my-3">
                    <div>
                        <button class="btn btn-secondary me-1" wire:click="prevDate"
                            @if ($startDate == $endDate) disabled @endif>
                            ก่อนหน้า
                        </button>

                        <button class="btn btn-secondary" wire:click="nextDate"
                            @if ($startDate == $endDate) disabled @endif>
                            ถัดไป
                        </button>
                    </div>

                    <span class="fw-bold flex-grow-1 text-center w-50">
                        วันที่
                        {{ \Carbon\Carbon::parse($startDate)->addYears(543)->locale('th')->translatedFormat('d F Y') }}
                        ถึง
                        วันที่
                        {{ \Carbon\Carbon::parse($endDate)->addYears(543)->locale('th')->translatedFormat('d F Y') }}
                    </span>
                </div>

                <div class="d-flex">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-secondary text-white">
                                <tr class="text-center">
                                    <th>ลำดับ</th>
                                    <th>เจ้าของงาน</th>
                                    <th>ชื่องาน</th>
                                    <th>รายละเอียดงาน</th>
                                    <th>ประเภทงาน</th>
                                    <th>สถานะงาน</th>
                                    <th>วันครบกำหนดงาน</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tasks as $key => $task)
                                    <tr>
                                        <td class="text-center">{{ $tasks->firstItem() + $key }}</td>
                                        <td class="text-center text-truncate" style="max-width: 10px;">{{ $task->user->first_name ?? '-' }}</td>
                                        <td class="text-center text-truncate" style="max-width: 110px;">{{ $task->task_name ?? '-' }}</td>
                                        <td class="text-center text-truncate" style="max-width: 100px;">{{ $task->task_detail ?? '-' }}</td>
                                        <td class="text-center text-truncate" style="max-width: 100px;">{{ $task->task_type->type_name ?? '-' }}</td>
                                        <td class="text-center text-truncate" style="max-width: 20px;">{{ $task->task_status->task_status_name ?? '-' }}</td>
                                        <td class="text-center text-truncate" style="max-width: 10px;">
                                            {{ \Carbon\Carbon::parse($task->due_date)->addYears(543)->locale('th')->translatedFormat('d F Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">ไม่มีข้อมูล</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $tasks->links('vendor.livewire.task-paginate') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
