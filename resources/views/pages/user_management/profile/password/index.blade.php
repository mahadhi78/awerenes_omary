@extends('layouts.app')

@section('title', 'Change Password ')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content justify-content-center">
                        @include('pages.user_management.profile.password.create')

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $(".indicator-progress").toggle(false);

            function updateForm() {

                $("#changePasswordBtn").prop('disabled', true);
                $(".indicator-progress").toggle(true);
                $(".indicator-label").hide();
                var old_password = $("#old_password").val();
                var password = $("#password").val();
                var password_confirmation = $("#password_confirmation").val();

                if (old_password == "") {
                    swal("Previous Password is Required", {
                            icon: "warning"
                        })
                        .then((m) => {
                            $("#changePasswordBtn").prop('disabled', false);
                            $(".indicator-progress").toggle(false);
                            $(".indicator-label").show();
                        });
                    return false;
                }

                if (password == "" || password.length < 8) {
                    swal("Password is Required and Minimum Length must be 8 ", {
                            icon: "warning"
                        })
                        .then((m) => {
                            $("#changePasswordBtn").prop('disabled', false);
                            $(".indicator-progress").toggle(false);
                            $(".indicator-label").show();
                        });
                    return false;
                }

                if (password_confirmation == "" || password_confirmation.length < 8 ||
                    password_confirmation != password) {
                    swal("Confirmation Password is Required and Minimum Length must be 8, and must match with the Password ", {
                            icon: "warning"
                        })
                        .then((m) => {
                            $("#changePasswordBtn").prop('disabled', false);
                            $(".indicator-progress").toggle(false);
                            $(".indicator-label").show();
                        });
                    return false;
                }

                var formData = new FormData();
                formData.append('old_password', old_password);
                formData.append('password', password);
                formData.append('password_confirmation', password_confirmation);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('profile.updatePassword') }}',
                    data: formData,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        switch (data.success) {
                            case true:
                                swal(data.response, {
                                        icon: "success"
                                    })
                                    .then((m) => {
                                        window.location.reload();
                                    });
                                break;

                            case "login":
                                swal(data.response, {
                                        icon: "success"
                                    })
                                    .then((m) => {
                                        window.location.replace("/login");
                                    });
                                break;
                            case false:

                                if (data.response.hasOwnProperty('password')) {
                                    swal(data.response.password[0], {
                                            icon: "warning"
                                        })
                                        .then((m) => {
                                            $("#changePasswordBtn").prop('disabled', false);
                                            $(".indicator-progress").toggle(false);
                                            $(".indicator-label").show();
                                        });
                                } else {
                                    swal(data.response, {
                                            icon: "warning"
                                        })
                                        .then((m) => {
                                            $("#changePasswordBtn").prop('disabled', false);
                                            $(".indicator-progress").toggle(false);
                                            $(".indicator-label").show();
                                        });
                                }

                                break;
                        }
                    },
                    error: function(data) {
                        swal("An error Occurred, Please Contact System Support", {
                            icon: "warning"
                        }).then((m) => {
                            $("#changePasswordBtn").prop('disabled', false);
                            $(".indicator-progress").toggle(false);
                            $(".indicator-label").show();
                        });
                        return false;
                    }
                });
            };
        </script>
    @endpush
@endsection
