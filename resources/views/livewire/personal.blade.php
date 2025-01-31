<div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>บุคลากร</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Personel</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 1%">ลำดับ</th>
                            <th style="width: 10%">ชื่อ-นามสกุล</th>
                            <th style="width: 1%">อีเมล</th>
                            <th style="width: 1%">สถานะบุคลากร</th>
                            <th style="width: 10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($data) && $data->isNotEmpty())
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->user_id }}</td>
                                    <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td class="text-center">
                                        @if ($item->account_status_id == 1)
                                            <button wire:click="updateStatus({{ $item->user_id }}, 2)"
                                                class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @else
                                            <button wire:click="updateStatus({{ $item->user_id }}, 1)"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td class="project-actions text-right">
                                        <a href="{{ route('profile-view', ['id' => $item->user_id]) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-folder"> View</i>
                                        </a>
                                        <a href="{{ route('profile-edit', ['id' => $item->user_id]) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"> Edit</i>
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                            wire:click.prevent="delete({{ $item->user_id }})">
                                            <i class="fas fa-trash"> Delete</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No data available</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            {{ $data->links() }}
        </section>
        <!-- /.content -->
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('confirmDelete', event => { // รับ Event จาก Livewire
            Swal.fire({ // แสดง SweetAlert
                title: 'Are you sure?',
                text: "คุณต้องการลบผู้ใช้นี้หรือไม่ ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, ลบเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) { 
                    @this.call('deleteUser', event.detail); // เรียก Livewire Method deleteUser
                }
            });
        });

        window.addEventListener('alert', event => { // รับ Event จาก Livewire
            Swal.fire({ // แสดง SweetAlert
                title: "ลบแล้ว!",
                text: "ลบงานเรียบร้อยแล้ว",
                icon: "success"
            });
        });
    });
</script>
