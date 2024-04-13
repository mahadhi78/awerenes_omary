@extends('layouts.app')
@section('links')
    <link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
@endsection
@section('title', 'Profile ')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox ">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="ibox-content text-center">
                                <div class="row">
                                    <span>
                                        <a href="#" class="btn btn-primary btn-sm me-3" data-toggle="modal"
                                            data-target="#editUserProfilePhoto">&nbsp;<i class="fa fa-edit"></i></a>
                                        change photo
                                    </span>
                                </div>
                                <div class="m-b-sm">
                                    @if ($profile = Auth::user()->photo_path)
                                        <img style="width:200px;height:200px;" class="rounded-circle"
                                            src="{{ asset('' . $profile) }}">
                                    @else
                                        <img style="width:200px;height:200px;" class="rounded-circle"
                                            src="{{ asset('assets/images/user_logo.jfif') }}">
                                    @endif
                                </div>
                                <h3>{{ Auth::user()->firstName }} 
                                    {{ Auth::user()->lastName }}</h3>
                                <hr>

                                <div class="text-left">
                                    <div class="row mb-7">
                                        <label class="col-lg-4 bold"><b>Role :</b>
                                        </label>
                                        <div class="col-lg-8">
                                            <span class="fw fs-6">{{ $getRoleName }} </span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-7">
                                        <label class="col-lg-4 "><b>Email :</b>
                                        </label>
                                        <div class="col-lg-8">
                                            <span class="fw fs-6">{{ Auth::user()->email }} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            
                            <div class="ibox-content">
                                @include('pages.user_management.profile.details')
                                @include('pages.user_management.profile.upload_photo')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{-- <script src="{{ asset('cms/js/sweetalert.min.js') }} "></script> --}}
        <script type="text/javascript">
            $(".indicator-progress").toggle(false);

            function updateProfileForm() {
                $("#editUserProfileBtn").prop('disabled', true);
                $(".indicator-progress").toggle(true);
                $(".indicator-label").hide();
                var firstname = $("#firstname").val();
                var middlename = $("#middlename").val();
                var lastname = $("#lastname").val();
                var phone_number = $("#phone_number").val();
                var check_number = $("#check_number").val();
                var email = $("#email").val();

                var formData = new FormData();
                formData.append('firstname', firstname);
                formData.append('middlename', middlename);
                formData.append('lastname', lastname);
                formData.append('phone_number', phone_number);
                formData.append('check_number', check_number);
                formData.append('email', email);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('profile.updateAdmin') }}',
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
                            case false:
                                if (data.response.hasOwnProperty('firstname')) {
                                    swal(data.response.firstname[0], {
                                            icon: "warning"
                                        })
                                        .then((m) => {
                                            $("#editUserProfileBtn").prop('disabled', false);
                                            $(".indicator-progress").toggle(false);
                                            $(".indicator-label").show();
                                        });
                                }
                                if (data.response.hasOwnProperty('lastname')) {
                                    swal(data.response.lastname[0], {
                                            icon: "warning"
                                        })
                                        .then((m) => {
                                            $("#editUserProfileBtn").prop('disabled', false);
                                            $(".indicator-progress").toggle(false);
                                            $(".indicator-label").show();
                                        });
                                }

                                if (data.response.hasOwnProperty('phone_number')) {
                                    swal(data.response.phone_number[0], {
                                            icon: "warning"
                                        })
                                        .then((m) => {
                                            $("#editUserProfileBtn").prop('disabled', false);
                                            $(".indicator-progress").toggle(false);
                                            $(".indicator-label").show();
                                        });
                                }

                                if (data.response.hasOwnProperty('check_number')) {
                                    swal(data.response.check_number[0], {
                                            icon: "warning"
                                        })
                                        .then((m) => {
                                            $("#editUserProfileBtn").prop('disabled', false);
                                            $(".indicator-progress").toggle(false);
                                            $(".indicator-label").show();
                                        });
                                }

                                if (data.response.hasOwnProperty('email')) {
                                    swal(data.response.email[0], {
                                            icon: "warning"
                                        })
                                        .then((m) => {
                                            $("#editUserProfileBtn").prop('disabled', false);
                                            $(".indicator-progress").toggle(false);
                                            $(".indicator-label").show();
                                        });
                                }

                                break;

                            case "failure":
                                swal(data.response, {
                                    icon: "warning"
                                }).then((m) => {
                                    $("#editUserProfileBtn").prop('disabled', false);
                                    $(".indicator-progress").toggle(false);
                                    $(".indicator-label").show();
                                });

                                break;
                        }
                    },
                    error: function(data) {
                        swal("An error Occurred, Please Contact System Support", {
                            icon: "warning"
                        }).then((m) => {
                            $("#editUserProfileBtn").prop('disabled', false);
                            $(".indicator-progress").toggle(false);
                            $(".indicator-label").show();
                        });
                        return false;
                    }
                });
            };

            

            function displayUserProfile() {
                document.getElementById("firstname").value = '<?php echo Auth::user()->firstname; ?>';
                document.getElementById("middlename").value = '<?php echo Auth::user()->middlename; ?>';
                document.getElementById("lastname").value = '<?php echo Auth::user()->lastname; ?>';
                document.getElementById("phone_number").value = '<?php echo Auth::user()->phone_number; ?>';
                document.getElementById("check_number").value = '<?php echo Auth::user()->check_number; ?>';
                document.getElementById("email").value = '<?php echo Auth::user()->email; ?>';
            }

            function updateProfilePhotoForm() {
                $("#editUserProfilePhotoBtn").prop('disabled', true);
                $(".indicator-progress").toggle(true);
                $(".indicator-label").hide();

                var url = document.getElementById("photo_url").value;
               

                var formData = new FormData()
                formData.append('id', '<?php echo Auth::user()->id; ?>');
                if (url != '' && url != null) {
                    formData.append('photo_url', $("#photo_url")[0].files[0]);
                }


                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('staffs.updatePhoto') }}',
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

                            case "failure":
                                swal(data.response, {
                                    icon: "warning"
                                }).then((m) => {
                                    $("#editUserProfilePhotoBtn").prop('disabled', false);
                                    $(".indicator-progress").toggle(false);
                                    $(".indicator-label").show();
                                });

                                break;
                        }
                    },
                    error: function(data) {
                        swal("An error Occurred, Please Contact System Support", {
                            icon: "warning"
                        }).then((m) => {
                            $("#editUserProfilePhotoBtn").prop('disabled', false);
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
