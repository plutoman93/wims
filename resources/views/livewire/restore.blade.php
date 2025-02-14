<div>
    <div class="content-wrapper">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="restore-account-tab" data-toggle="tab" href="#restore-account" role="tab"
                    aria-controls="restore-account" aria-selected="true">กู้คืนบัญชี</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="restore-task-tab" data-toggle="tab" href="#restore-task" role="tab"
                    aria-controls="restore-task" aria-selected="false">กู้คืนข้อมูลงาน</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="restore-account" role="tabpanel"
                aria-labelledby="restore-account-tab">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <button class="btn btn-success"
                            wire:click="confirmRestoreSelectedUsers">กู้คืนบัญชีที่เลือก</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-secondary text-white">
                            <tr class="text-center">
                                <th><input type="checkbox" wire:model="selectAllUsers"></th>
                                <th>ลำดับ</th>
                                <th>ชื่อผู้ใช้</th>
                                <th>อีเมล</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="text-center"><input type="checkbox" wire:model="selectedUsers"
                                            value="{{ $user->user_id }}"></td>
                                    <td class="text-center">{{ $user->user_id }}</td>
                                    <td class="text-center">{{ $user->username }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-success btn-sm"
                                            wire:click="restoreUser({{ $user->user_id }})">
                                            <i class="fas fa-undo"> กู้คืน</i>
                                        </a>
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
            <div class="tab-pane fade" id="restore-task" role="tabpanel" aria-labelledby="restore-task-tab">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <button class="btn btn-success"
                            wire:click="confirmRestoreSelectedTasks">กู้คืนงานที่เลือก</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-secondary text-white">
                            <tr class="text-center">
                                <th><input type="checkbox" wire:model="selectAllTasks"></th>
                                <th>ลำดับ</th>
                                <th>ชื่องาน</th>
                                <th>รายละเอียด</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $task)
                                <tr>
                                    <td class="text-center"><input type="checkbox" wire:model="selectedTasks"
                                            value="{{ $task->task_id }}"></td>
                                    <td class="text-center">{{ $task->task_id }}</td>
                                    <td class="text-center text-truncate" style="max-width: 200px;">
                                        {{ $task->task_name }}</td>
                                    <td class="text-center text-truncate" style="max-width: 200px;">
                                        {{ $task->task_detail }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-success btn-sm"
                                            wire:click="restoreTask({{ $task->task_id }})">
                                            <i class="fas fa-undo"> กู้คืน</i>
                                        </a>
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
        window.addEventListener('confirmRestoreSelectedUsers', event => {
            Swal.fire({
                title: 'คุณแน่ใจใช่มั้ย?',
                text: "คุณต้องการกู้คืนบัญชีที่เลือกทั้งหมดหรือไม่ ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, กู้คืนเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call(
                    'restoreSelectedUsers'); // เรียก Livewire Method restoreSelectedUsers
                }
            });
        });

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
