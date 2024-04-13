<div class="mt-2">
    <table id="uniform_published" class="table table-striped table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Uniform Category</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Published Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($publishedList as $list)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $list->category_name }}</td>
                    <td>{{ $list->qty }}</td>
                    <td>{{ ($list->qty)*($list->amount) }}</td>
                    <td>{{ $list->pub_date }}</td>
                    <td>{{ $list->qty }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

