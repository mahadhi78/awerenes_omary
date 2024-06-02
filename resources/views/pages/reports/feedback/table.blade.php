<div class="mt-2">
    <table id="dataTableList" class="table table-striped table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Reported By</th>
                <th>Type</th>
                <th>preview</th>

                @canany(['levels-edit', 'levels-delete'])
                    <th>Action</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @foreach ($report as $list)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $list->firstname . ' ' . $list->middlename . ' ' . $list->lastname }}</td>
                    <td>{{ $list->type_name }} </td>
                    <td style="width: 5%">
                        <button type="button" class="btn btn-sm btn-secondary rounded-pill" title="Preview Document"
                            onclick="previewDocument( {{ $list->id }})">
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
