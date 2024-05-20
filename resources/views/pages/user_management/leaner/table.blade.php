<div class="mt-2">
    <table id="dataTableList" class="table table-striped table-hover table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Gender</th>
                <th> Status</th>
                @canany(['staffs-edit', 'staffs-delete'])
                    <th>Action</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @foreach ($leaners as $list)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td> {{ $list->firstname }} {{ $list->middlename }} {{ $list->lastname }}</td>
                    <td>{{ $list->email }}</td>
                    <td>{{ $list->phone_number }}</td>
                    <td>{{ $list->gender }}</td>
                    <td>

                        @if ($list->status == $activeStatus)
                            <span class="badge bg-primary">{{ $list->status }}</span>
                        @else
                            <span class="badge bg-danger">{{ $list->status }}</span>
                        @endif
                    </td>
                    @canany(['learners-edit', 'learners-delete'])
                        <td>
                            @can('learners-edit')
                                <a href="{{ route('learners.edit', $list->id) }}" class="btn btn-default btn-xs">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('learners-delete')
                                <button class="btn btn-danger" onclick="deleteUser({{ $list->id }})">
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
