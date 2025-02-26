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

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{-- {{ $data->links('vendor.livewire.task-paginate') }} --}}
                        </div>
                    </div>

                    <!-- กล่องด้านข้างสำหรับแสดงข้อมูล -->
                    <div class="ms-3 p-3 border rounded shadow" style="width: 30%; background-color: #f8f9fa;">
                        <h5 class="text-primary">ข้อมูลเพิ่มเติม</h5>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
