<div class="mt-2">
    <table id="dataTableList" class="table table-striped table-hover table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Approval Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $list)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td> {{ $list->firstname }} {{ $list->middlename }} {{ $list->lastname }}</td>
                    <td>{{ $list->email }}</td>
                    <td>{{ $list->userType }}</td>
                    <td>
                        <p class="badge bg-info">{{ $list->is_approved }}</p>
                    </td>
                    <td>
                        @if (Gate::check('user_approval-edit'))
                            <a class='btn btn-default' onclick="approvaStaff({{ $list->id }})">
                                <i class="fa fa-check"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
