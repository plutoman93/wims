<div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>แก้ไขข้อมูลงาน</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        {{-- @dd(555) --}}
        <!-- Main content -->
        <section class="content">
            <form wire:submit.prevent="edit">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header bg-dark">
                                <h3 class="card-title">กรอกข้อมูลงาน</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">ชื่องาน</label>
                                    <input type="text" id="inputName1" wire:model="task_name" class="form-control">
                                    @error('task_name')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputName">รายละเอียดงาน</label>
                                    <input type="text" id="inputName2" wire:model="task_detail" class="form-control">
                                    @error('task_detail')
                                        <span class ="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="start_date">วันที่เริ่มต้น</label>
                                        <div class="flatpickr-wrapper">
                                            <input type="date" id="start_date" wire:model="start_date"
                                                class="form-control flatpickr" placeholder="วัน/เดือน/ปี">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="due_date">วันที่เสร็จสิ้น</label>
                                        <div class="flatpickr-wrapper">
                                            <input type="date" id="due_date" wire:model="due_date"
                                                class="form-control flatpickr" placeholder="วัน/เดือน/ปี">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">ชนิดงาน</label>
                                    <select id="inputStatus" wire:model="type_id" class="form-control custom-select">
                                        <option value="">เลือกชนิดงาน</option>
                                        <option value="1">ปฏิบัติราชการ</option>
                                        <option value="2">ลากิจ</option>
                                        <option value="3">ประชุม</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">สถานะงาน</label>
                                    <select id="inputStatus" wire:model="task_status_id"
                                        class="form-control custom-select">
                                        <option value="">เลือกสถานะงาน</option>
                                        <option value="1">เสร็จสิ้น</option>
                                        <option value="2">ยังไม่เสร็จสิ้น</option>
                                    </select>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success floar-right ">แก้ไข</button>
                            <button type="button" class="btn btn-danger" wire:click="resetForm">ยกเลิก</button>
                        </div>
                    </div>
            </form>
        </section>

        <!-- /.content -->
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('input[type="date"]').forEach(input => {
            input.addEventListener('change', function() {
                let date = new Date(this.value);
                if (!isNaN(date)) {
                    let year = date.getFullYear() + 543;
                    let month = ('0' + (date.getMonth() + 1)).slice(-2);
                    let day = ('0' + date.getDate()).slice(-2);
                    this.value = `${year}-${month}-${day}`;
                }
            });
        });
    });
</script>
