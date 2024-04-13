<table id="dataTableList" class="table table-striped table-bordered" style="width:100%;">
    <thead>
        <tr>
            <th>#</th>
            <th>Ip Address</th>
            <th>login Date</th>
            <th>user Agent</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($history as $list)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td style="width: 10%">{{ $list->ip_address }}</td>
            <td>{{ $list->login_at }}</td>
            <td>{{ $list->user_agent }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
