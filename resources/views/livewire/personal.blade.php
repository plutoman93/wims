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
                            <th style="width: 1%">ID.</th>
                            <th style="width: 10%">Full Name</th>
                            <th style="width: 1%">Email</th>
                            <th style="width: 1%">Status</th>
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
                                            <a href="{{ route('user.status', ['user_id' => $item->user_id, 'account_status_id' => 2]) }}"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-ban"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('user.status', ['user_id' => $item->user_id, 'account_status_id' => 1]) }}"
                                                class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i>
                                            </a>
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
                                        <a class="btn btn-danger btn-sm" wire:click="delete({{ $item->user_id }})">
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
