<div>
    <div class="content-wrapper">
        <div class="card shadow-sm"></div>
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0 text-center">กู้คืนข้อมูลงาาน</h4>
        </div>
        <div class="tab-content mt-3" id="restoreTabContent">
            <!-- Restore Account Tab -->
            <div class="tab-pane fade show active" id="restore-account" role="tabpanel"
                aria-labelledby="restore-account-tab">

                <!-- ปุ่มกู้คืนที่เลือก -->
                <div class="d-flex justify-content-between mb-3">
                    <button class="btn btn-success " wire:click="confirmRestoreSelectedTasks">
                        <i class="fas fa-undo-alt"></i> กู้คืนบัญชีที่เลือก
                    </button>
                </div>

                <!-- ตารางข้อมูล -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-secondary text-white text-center">
                            <tr>
                                <th><input type="checkbox" wire:model="selectAllUsers"></th>
                                <th>ลำดับ</th>
                                <th>ชื่องาน</th>
                                <th>รายละเอียดงาน</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $task)
                                <tr class="text-center">
                                    <td><input type="checkbox" wire:model="selectedUsers" value="{{ $task->task_id }}"></td>
                                    <td>{{ $task->task_id }}</td>
                                    <td class="text-center text-truncate" style="max-width: 200px;">{{ $task->task_name }}</td>
                                    <td class="text-center text-truncate" style="max-width: 400px;">{{ $task->task_detail }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm"
                                            wire:click="restoreTask({{ $task->task_id }})">
                                            <i class="fas fa-undo-alt"></i> กู้คืน
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">ไม่พบข้อมูล</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('confirmRestoreSelectedTasks', event => {
            Swal.fire({
                title: 'คุณแน่ใจใช่มั้ย?',
                text: "คุณต้องการกู้คืนงานที่เลือกทั้งหมดหรือไม่ ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, กู้คืนเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call(
                        'restoreSelectedTasks'); // เรียก Livewire Method restoreSelectedTasks
                }
            });
        });

        window.addEventListener('alert', event => {
            Swal.fire({
                title: "สำเร็จ!",
                text: event.detail.message,
                icon: event.detail.type
            });
        });
    });
</script>
