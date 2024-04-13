<div class="mt-2">
    <table id="dataTableList" class="table table-striped table-hover table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Approval Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($student as $list)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-capitalize"> {{ $list->first_name }} {{ $list->middle_name }} {{ $list->lastname }}</td>
                    <td>{{ $list->gender }}</td>
                    <td>
                        <p class="badge bg-info">{{ $list->is_approved }}</p>
                    </td>
                    <td>
                        {{-- @if (Gate::check('users_approval-edit')) --}}
                            <a class='btn btn-default' onclick="approvaStudent({{ $list->id }})">
                                <i class="fa fa-check"></i>
                            </a>
                        {{-- @endif --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
