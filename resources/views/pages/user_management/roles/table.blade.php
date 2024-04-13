<div class="mt-2">
    <table id="dataTableList" class="table table-striped table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Role Name</th>
                <th>Status</th>
                @canany(['roles-edit', 'roles-delete'])
                    <th>Action</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $list)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $list->name }}</td>
                    <td>
                        @if ($list->status == 'Active')
                            <span class="badge bg-primary">{{ $list->status }}</span>
                        @else
                            <span class="badge bg-danger">{{ $list->status }}</span>
                        @endif
                    </td>
                    @canany(['roles-edit', 'roles-delete'])
                        <td>
                            @can('roles-edit')
                                <a href="{{ route('roles.edit', [$list->id]) }}" class='btn btn-default btn-xs'>
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('roles-delete')
                                @if ($list->name != Constants::ROLE_SUPER_ADMINISTRATOR)
                                    <button type="button" class="btn btn-danger btn-xs"
                                        onclick="confirmDelete({{ $list->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                @endif
                            @endcan
                        </td>
                    @endcanany
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
