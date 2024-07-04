<div class="mt-2">
    <table id="dataTableList" class="table table-striped table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Type Name</th>
                <th>Read More</th>
                @canany(['news-edit', 'news-delete'])
                    <th>Action</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @foreach ($news as $list)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $list->new_name }}</td>
                    <td style="width: 20%">
                        <button type="button" class="btn btn-sm btn-secondary rounded-pill" title="Preview Document"
                            onclick="previewInfo( {{ $list->id }})">
                            <i class="fa fa-eye"></i>
                        </button>
                    </td>
                    @canany(['news-edit', 'news-delete'])
                        <td style="width: 15%">
                            @can('news-edit')
                                <a href="{{ route('news.edit', Common::hash($list->id)) }}" class="btn btn-default btn-xs">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('news-delete')
                                <button class='btn btn-danger btn-sm' onclick="deleteNews({{ $list->id }})">
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
