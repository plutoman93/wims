<div>
    <div class="content-wrapper">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">สรุปตารางงาน</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 mb-3"> <!-- เพิ่ม mb-3 -->
                        <input type="search" class="form-control" placeholder="ค้นหาชื่องาน" wire:model.live="search">
                    </div>
                    <div class="col-md-4 mb-3"> <!-- เพิ่ม mb-3 -->
                        <select class="form-control">
                            <option value="">เลือกผู้ใช้</option>
                        </select>
                    </div>
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
                                    <th>เจ้าของงาน</th>
                                    <th>ชื่องาน</th>
                                    <th>ประเภทงาน</th>
                                    <th>เวลาสิ้นสุด</th>
                                    <th>สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $key => $item)  {{-- วนลูปผ่านตัวแปร $data ซึ่งเป็นรายการของภารกิจ โดยใช้ $key เป็นดัชนี --}}
                                <tr>
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
