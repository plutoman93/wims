<div>
    <div class="content-wrapper">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">สรุปตารางงาน</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    @can('can-filter-task')
                        <div class="col-md-4 mb-3"> <!-- เพิ่ม mb-3 -->
                            <select class="form-control">
                                <option value="">เลือกผู้ใช้</option>

                            </select>
                        </div>
                    @endcan
                    <div class="col-md-4 mb-3"> <!-- เพิ่ม mb-3 -->
                        <select class="form-control">
                            <option value="">เลือกวันที่</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3"> <!-- เพิ่ม mb-3 -->
                        <select class="form-control">
                            <option value="">เลือกช่วงเวลา</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex">
                    <!-- ตารางหลัก -->
                    <div class="table-responsive" style="width: 66.66%;">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-secondary text-white">
                                <tr class="text-center">
                                    <th>ลำดับ</th>
                                    <th>ชื่องาน</th>
                                    <th>เจ้าของงาน</th>
                                    <th>ประเภทงาน</th>
                                    <th>วันครบกำหนดงาน</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $key => $task)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $task->task_name ?? '-' }}</td>
                                        <td class="text-center">{{ $task->user->first_name ?? '-' }}</td>
                                        <td class="text-center">{{ $task->task_type->type_name ?? '-' }}</td>
                                        <td class="text-center">
                                            {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->locale('th')->translatedFormat('d F Y') : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            {{-- {{ $data->links('vendor.livewire.task-paginate') }} --}}
                        </div>
                    </div>

                    <!-- กล่องด้านข้าง -->
                    <div class="d-flex flex-column ms-3" style="width: 30%;">
                        <div class="p-3 border rounded shadow mb-3" style="background-color: #f8f9fa;">
                            <h5 class="text-primary">ข้อมูลเพิ่มเติม</h5>
                        </div>
                        <div class="p-3 border rounded shadow" style="background-color: #f8f9fa;">
                            <h5 class="text-primary">ข้อมูลเพิ่มเติม</h5>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
