@if (Session::has('success'))
    <script>
        swal({
            text: "{{ Session::get('success') }}",
            icon: "success",
            timer: 1500,
            showConfirmButton: false,
        });
    </script>
@endif
@if (Session::has('error'))
    <script>
        swal({
            text: "{{ Session::get('error') }}",
            icon: "error",
            timer: 1500,
            showConfirmButton: true,
        });
    </script>
@endif

