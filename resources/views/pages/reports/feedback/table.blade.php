<div class="mt-2">
    <table id="dataTableList" class="table table-striped table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th>#</th>
                @unless (Auth::user()->userType == Constants::LEARNER)
                    <th>Reported By</th>
                @endunless
                <th>Type</th>
                <th>{{ Auth::user()->userType != Constants::LEARNER ? 'preview' : 'Action' }}</th>
                @canany(['report-edit', 'report-delete'])
                    <th>Action</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @foreach ($report as $list)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @unless (Auth::user()->userType == Constants::LEARNER)
                        <td>{{ $list->firstname . ' ' . $list->middlename . ' ' . $list->lastname }}</td>
                    @endunless
                    <td>{{ $list->type_name }} </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-secondary rounded-pill" title="Preview Document"
                            onclick="previewDocument( {{ $list->id }})">
                            <i class="fa fa-eye"></i>
                        </button>
                        @if (Auth::user()->userType == Constants::LEARNER)
                            <a href="{{ route('report.edit', Common::hash($list->id)) }}" class="btn btn-default ">
                                <i class="fa fa-edit"></i>
                            </a>
                        @endif

                    </td>
                    @canany(['report-edit', 'report-delete'])
                        <td>
                            @if ($list->is_deleted)
                                <button class='btn btn-info btn-sm' onclick="restoreFeedback({{ $list->id }})">
                                    <i class="fa fa-refresh"></i>
                                </button>
                            @else
                                @can('report-delete')
                                    <button class='btn btn-danger btn-sm' onclick="deleteFeedback({{ $list->id }})">
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
