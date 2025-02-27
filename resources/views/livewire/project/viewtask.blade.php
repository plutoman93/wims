<div>
    <div class="content-wrapper">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0 text-center">จัดการข้อมูลตารางงาน</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 mb-3"> <!-- เพิ่ม mb-3 -->
                        <input type="search" class="form-control" placeholder="ค้นหาชื่องาน" wire:model.live="search">
                    </div>
                    @can('can-filter-task')
                        <div class="col-md-4 mb-3"> <!-- เพิ่ม mb-3 -->
                            <select class="form-control" wire:model.live="selectedUser">
                                <option value="">เลือกผู้ใช้</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->user_id }}">{{ $user->first_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endcan
                    <div class="col-md-4 mb-3"> <!-- เพิ่ม mb-3 -->
                        <select class="form-control" wire:model.live="statusFilter">
                            <option value="">งานทั้งหมด</option>
                            <option value="1">เสร็จสิ้น</option>
                            <option value="2">ยังไม่เสร็จสิ้น</option>
                        </select>
                    </div>
                    <div class="col-md-4 text-right mb-3"> <!-- เพิ่ม mb-3 -->
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
                        <a href="{{ url('export-tasks') }}" class="btn btn-primary ml-2">Export เป็น Excel</a>
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
                            @forelse ($data as $key => $item)  {{-- วนลูปผ่านตัวแปร $data ซึ่งเป็นรายการของภารกิจ โดยใช้ $key เป็นดัชนี --}}
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" wire:model="selectedTasks" value="{{ $item->task_id }}">
                                        {{-- ช่องทำเครื่องหมาย (checkbox) ใช้เลือกภารกิจ โดยใช้ Livewireเพื่อเก็บค่าที่เลือกไว้ในตัวแปร selectedTasks --}}
                                    </td>
                                    <td class="text-center">{{ $data->firstItem() + $key }}</td>
                                    {{-- แสดงลำดับของรายการ โดยใช้ firstItem() เพื่อให้รองรับ pagination --}}
                                    <td class="text-center">{{ $item->user->first_name }}</td>
                                    {{-- แสดงชื่อของผู้ใช้ที่เกี่ยวข้องกับภารกิจ --}}
                                    <td class="text-center text-truncate" style="max-width: 200px;">
                                        {{ $item->task_name }}
                                        {{-- แสดงชื่อของภารกิจ โดยใช้ text-truncate และ max-widthเพื่อให้ข้อความไม่ยาวเกินไป --}}
                                    </td>
                                    <td class="text-center text-truncate" style="max-width: 400px;">
                                        {{ $item->task_detail }}
                                        {{-- แสดงรายละเอียดของภารกิจ โดยใช้ text-truncate และ max-width เช่นกัน --}}
                                    </td>
                                    <td class="text-center">{{ $item->task_type->type_name }}</td>
                                    {{-- แสดงประเภทของภารกิจ --}}
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->start_date)->locale('th')->translatedFormat('d F Y') }}
                                        {{-- แปลงวันที่เริ่มต้นของภารกิจให้อยู่ในรูปแบบที่อ่านง่าย โดยใช้ Carbonและแสดงเป็นภาษาไทย --}}
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->due_date)->locale('th')->translatedFormat('d F Y') }}
                                        {{-- แปลงวันครบกำหนดส่งของภารกิจให้อยู่ในรูปแบบที่อ่านง่าย โดยใช้ Carbonและแสดงเป็นภาษาไทย --}}
                                    </td>
                                    <td class="text-center">
                                        @if ($item->task_status_id == 1)
                                            {{-- ตรวจสอบว่าสถานะของภารกิจเป็น 1 (ยังไม่เสร็จสิ้น) --}}
                                            <button wire:click="taskStatus({{ $item->task_id }}, 2)" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            {{-- ปุ่มเปลี่ยนสถานะเป็นเสร็จสิ้น (2) --}}
                                        @else
                                            <button wire:click="taskStatus({{ $item->task_id }}, 1)" class="btn btn-uncomplete btn-sm">
                                                <i class="fas fa-hourglass-half"></i>
                                            </button>
                                            {{-- ปุ่มเปลี่ยนสถานะกลับเป็นยังไม่เสร็จสิ้น (1) --}}
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
                                {{-- กรณีที่ไม่มีข้อมูลภารกิจให้แสดงข้อความ --}}
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
    document.addEventListener('DOMContentLoaded', function () {
        // ... (โค้ด JavaScript ส่วนอื่น ๆ)

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
