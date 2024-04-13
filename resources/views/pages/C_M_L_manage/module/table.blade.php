<div class="mt-2">
    <table id="dataTableList" class="table table-striped table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Level </th>
                <th>Course </th>
                <th>Module Name</th>
                @canany(['course-edit', 'course-delete'])
                    <th>Action</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @foreach ($module as $list)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $list->lv_name }}</td>
                    <td>{{ $list->course_name }}</td>
                    <td>{{ $list->m_name }}</td>
                    

                    @canany(['course-edit', 'course-delete'])
                        <td>
                            @if ($list->is_deleted)
                                <button class='btn btn-info btn-sm' onclick="restoreClass({{ $list->id }})">
                                    <i class="fa fa-refresh"></i>
                                </button>
                            @else
                                @can('course-edit')
                                    <a class='btn btn-default btn-sm' onclick="editClass({{ $list->id }})">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan
                                @can('course-delete')
                                    <button class='btn btn-danger btn-sm' onclick="deleteClass({{ $list->id }})">
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
