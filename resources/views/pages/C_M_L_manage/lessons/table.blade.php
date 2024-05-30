<div class="mt-2">
    <table id="dataTableList" class="table table-striped table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Course Name</th>
                <th>Module Name</th>
                <th>Lesson Name</th>
                @canany(['course-edit', 'course-delete'])
                    <th>Action</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @foreach ($lesson as $list)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a class='text text-primary' href="{{ route('course.preview', Common::hash($list->id)) }}">
                            {{ $list->c_name }}
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                    <td>{{ $list->lv_name }}</td>
                    <td>{{ $list->lesson_name }}</td>
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
