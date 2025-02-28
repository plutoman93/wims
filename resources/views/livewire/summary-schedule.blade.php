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
                            <select class="form-control" wire:model.live="selectedUser">
                                <option value="">เลือกผู้ใช้</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->user_id }}">{{ $user->first_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endcan

                    <div class="col-md-4 mb-3">
                        <select class="form-control" wire:model.live="dateFilter">
                            <option value="">เลือกวันที่</option>
                            @foreach ($dates->when(auth()->user()->user_status_id != 1, function ($filteredDates) {
                                return $filteredDates->filter(function ($date) {
                                    return \App\Models\Task::where('start_date', $date)
                                        ->where('user_id', auth()->id())
                                        ->exists();
                                });
                            }) as $date)
                                                            <option value="{{ $date }}">{{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}</option>
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
                                    <th>วันครบกำหนดงาน</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tasks as $key => $task)
                                    <tr>
                                        <td class="text-center">{{ $tasks->firstItem() + $key }}</td>
                                        <td class="text-center">{{ $task->user->first_name ?? '-' }}</td>
                                        <td class="text-center">{{ $task->task_name ?? '-' }}</td>
                                        <td class="text-center">{{ $task->task_detail ?? '-' }}</td>
                                        <td class="text-center">{{ $task->task_type->type_name ?? '-' }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($task->due_date)->translatedFormat('d F Y') }}</td>
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
                    <div class="d-flex flex-column ms-3" style="width: 30%;">
                        <!-- 🔹 ข้อมูลจำนวนงานแต่ละประเภท -->
                        <div class="p-3 border rounded shadow mb-3" style="background-color: #f8f9fa;">
                            <h5 class="text-primary fw-bold">จำนวนงานแต่ละประเภทในวันนี้</h5> <!-- ใช้ h4 -->
                            <ul class="list-unstyled">
                                @foreach ($taskCountsByType as $type => $count)
                                    <li class="text-lg fw-semibold text-dark">{{ $type }}: {{ $count }} งาน</li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- 🔹 ข้อมูลจำนวนงานแต่ละคน -->
                        <div class="p-3 border rounded shadow" style="background-color: #f8f9fa;">
                            <h5 class="text-primary fw-bold">จำนวนงานของแต่ละประเภทของบุคลากรในวันนี้</h5> <!-- ใช้ h4 -->
                            <ul class="list-unstyled">
                                @foreach ($taskCountsByUserAndType as $user => $tasks)
                                    <li class="text-lg fw-semibold text-blue">{{ $user }}:</li>
                                    <ul>
                                        @foreach ($tasks as $task)
                                            <li class="text-lg text-dark">{{ $task->type_name }}: {{ $task->count }} งาน</li>
                                        @endforeach
                                    </ul>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
