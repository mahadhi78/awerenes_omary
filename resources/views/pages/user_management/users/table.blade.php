<div class="mt-2">
    <table id="dataTableList" class="table table-striped table-hover table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email</th>
                <th> Status</th>
                @canany(['staffs-edit', 'staffs-delete'])
                    <th>Action</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $list)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td> {{ $list->firstname }} {{ $list->middlename }} {{ $list->lastname }}</td>
                    <td>{{ $list->email }}</td>
                    <td>
                        @if ($list->status == $activeStatus)
                            <span class="badge bg-primary">{{ $list->status }}</span>
                        @else
                            <span class="badge bg-danger">{{ $list->status }}</span>
                        @endif
                    </td>
                    @canany(['staffs-edit', 'staffs-delete'])
                        <td>
                            @can('staffs-edit')
                                <a href="{{ route('staffs.edit', $list->id) }}" class="btn btn-default btn-xs">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('staffs-delete')
                                <button class="btn btn-danger btn-xs" onclick="deleteUser({{ $list->id }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                            @endcan
                        </td>
                    @endcanany
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
