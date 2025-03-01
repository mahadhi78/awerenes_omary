<div class="mt-2">
    <table id="dataTableList" class="table table-striped table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>FAQ Name</th>
                <th>Preview</th>

                @canany(['levels-edit', 'levels-delete'])
                    <th>Action</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @foreach ($faqs as $list)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $list->name }}</td>
                    <td style="width: 20%">
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
                                    <a class='btn btn-default btn-sm' href="{{ route('faqs.edit', Common::hash($list->id)) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan
                                @can('levels-delete')
                                    <button class='btn btn-danger btn-sm' onclick="deleteFaq({{ $list->id }})">
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
