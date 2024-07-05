<div class="mt-2">
    <table id="dataTableList" class="table table-striped table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Compaign Name</th>
                <th>Start At</th>
                <th>End At</th>
                <th>Total Clicked</th>
                <th>Status</th>
                @canany(['compaign-edit', 'compaign-delete'])
                    <th>Action</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @foreach ($compaign as $list)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{-- <a class='text text-primary' href="{{ route('course.preview', Common::hash($list->id)) }}"> --}}
                            {{ $list->name }}
                            {{-- <i class="fa fa-eye"></i>
                        </a> --}}
                    </td>
                    <td>{{ $list->start_at }}</td>
                    <td>{{ $list->end_at }}</td>
                    <td>{{ $list->total_clicks }}</td>
                    
                    <td>
                        @if ($list->status == $activeStatus)
                            <span class="badge bg-primary">{{ $list->status }}</span>
                        @else
                            <span class="badge bg-danger">{{ $list->status }}</span>
                        @endif
                    </td>
                    @canany(['compaign-edit', 'compaign-delete'])
                        <td>
                            @if ($list->deleted_at)
                                <button title="restore" class='btn btn-danger btn-sm' onclick="restoreCompaign({{ $list->id }})">
                                    <i class="fa fa-refresh"></i>
                                </button>
                            @else
                                @can('compaign-edit')
                                    <a title="Edit" class='btn btn-default btn-sm' onclick="editCompaign({{ $list->id }})">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan
                                @can('compaign-delete')
                                    <button title="Delete" class='btn btn-danger btn-sm' onclick="deleteCompaign({{ $list->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                @endcan
                            @endif
                        </td>
                    @endcanany
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
