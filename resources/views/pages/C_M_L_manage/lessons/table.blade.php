<div class="mt-2">
    <table id="dataTableList" class="table table-striped table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Lesson Name</th>
                <th>Course Name</th>
                <th>Level Name</th>
                <th>Module Name</th>
                @canany(['lesson-edit', 'lesson-delete'])
                    <th>Action</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @foreach ($lesson as $list)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $list->lesson_name }}</td>
                    <td>
                        <a class='text text-primary' href="{{ route('course.preview', Common::hash($list->c_id)) }}">
                            {{ $list->course_name }}
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                    <td>{{ $list->lv_name }}</td>
                    <td>{{ $list->lesson_name }}</td>
                    @canany(['lesson-edit', 'lesson-delete'])
                        <td>
                            @can('lesson-edit')
                            <a href="{{ route('lesson.edit', Common::hash($list->id)) }}" class="btn btn-default btn-xs">
                                <i class="fa fa-edit"></i>
                            </a>
                            @endcan
                            @can('lesson-delete')
                                <button class='btn btn-danger btn-sm' onclick="deleteLesson({{ $list->id }})">
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
