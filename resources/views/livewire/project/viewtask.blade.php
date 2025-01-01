<div>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>ตารางงาน</h1>
        </section>

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <input type="text" class="form-control" placeholder="ค้นหา" wire:model="search">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 50px;">ลำดับ</th>
                                    <th>ชื่องาน</th>
                                    <th style="width: 120px;">วันเริ่มงาน</th>
                                    <th style="width: 150px;">วันครบกำหนดงาน</th>
                                    <th style="width: 120px;">สถานะงาน</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->task_id }}</td>
                                        <td class="text-center">{{ $item->task_name }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($item->due_date)->format('d-m-Y') }}</td>
                                        <td class="text-center">{{ $item->task_status }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">ไม่พบข้อมูล</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $data->links() }} <!-- ใช้ Pagination -->
                </div>
            </div>
        </section>
    </div>
</div>
