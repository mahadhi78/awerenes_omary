<div class="mt-2">
    <table id="dataTableList" class="table table-striped table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Type Name</th>
                <th>Status</th>

                @canany(['levels-edit', 'levels-delete'])
                    <th>Action</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @foreach ($news as $list)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $list->new_name }}</td>
                    <td style="width: 5%">
                        <button type="button" class="btn btn-sm btn-secondary rounded-pill" title="Preview Document"
                            onclick="previewInfo( {{ $list->id }})">
                            <i class="fa fa-eye"></i>
                        </button>
                    </td>
                    @canany(['levels-edit', 'levels-delete'])
                        <td>
                            @if ($list->is_deleted)
                                <button class='btn btn-info btn-sm' onclick="restoreSchool({{ $list->id }})">
                                    <i class="fa fa-refresh"></i>
                                </button>
                            @else
                                @can('levels-edit')
                                    <a class='btn btn-default btn-sm' onclick="editSchool({{ $list->id }})">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan
                                @can('levels-delete')
                                    <button class='btn btn-danger btn-sm' onclick="deleteSchool({{ $list->id }})">
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
