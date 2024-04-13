@extends('layouts.app')
@section('links')
    <link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
@endsection
@section('page_title', 'Staff Registration')

@section('content')
    @if (Gate::check('staffs-save'))
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()"
                                    class="btn btn-default  fa fa-arrow-circle-left"></a>&nbsp;&nbsp;
                                <h4>
                                    Staff @if ($user)
                                        Update
                                    @else
                                        Registration
                                    @endif
                                </h4>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form novalidate id="entryForm" action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="box-body">
                                   
                                    <h3><i class="fa fa-info" aria-hidden="true"> Personal info </i></h3>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group" id="firstname_validate">
                                                <label for="firstname">First Name <i class="text-danger">*</i></label>
                                                {!! Form::text('firstname', $user ? $user->firstname : '', [
                                                    'placeholder' => 'Enter First Name',
                                                    'class' => 'form-control form-control-solid',
                                                    'autocomplete' => 'off',
                                                    'minLength' => 3,
                                                    'maxLength' => 30,
                                                    'id' => 'firstname',
                                                ]) !!}

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="middlename_validate">
                                                <label for="middlename">Middle Name <i class="text-danger">*</i></label>
                                                {!! Form::text('middlename', $user ? $user->middlename : '', [
                                                    'placeholder' => 'Enter Middle Name',
                                                    'class' => 'form-control form-control-solid',
                                                    'autocomplete' => 'off',
                                                    'minLength' => 1,
                                                    'maxLength' => 30,
                                                    'id' => 'middlename',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="lastname_validate">
                                                <label for="lastname">Last Name <i class="text-danger">*</i></label>
                                                {!! Form::text('lastname', $user ? $user->lastname : '', [
                                                    'placeholder' => 'Enter Last Name',
                                                    'class' => 'form-control form-control-solid',
                                                
                                                    'autocomplete' => 'off',
                                                    'minLength' => 3,
                                                    'maxLength' => 30,
                                                    'id' => 'lastname',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="email_validate">
                                                <label for="email">Email <i class="text-danger">*</i></label>
                                                {!! Form::email('email', $user ? $user->email : '', [
                                                    'placeholder' => 'Enter Email',
                                                    'class' => 'form-control form-control-solid',
                                                
                                                    'autocomplete' => 'off',
                                                    'id' => 'email',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="phone_number_validate">
                                                <label for="phone_number">Phone Number <i class="text-danger">*</i></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                                                    {!! Form::number('phone_number', $user ? $user->phone_number : '', [
                                                        'placeholder' => 'Enter Phone Number',
                                                        'class' => 'form-control form-control-solid',
                                                        'maxlength' => 12,
                                                        'minlength' => 10,
                                                        'autocomplete' => 'off',
                                                        'id' => 'phone_number',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="roles">System Role <i class="text-danger">*</i></label>
                                                {!! Form::select('roles[]', $roles, [], ['class' => 'form-control form-control-solid', 'id' => 'roles']) !!}
                                            </div>
                                        </div>
                                        


                                    </div>
                                </div>
                                <hr>
                                <div class="box-footer">
                                    <a href="javascript:history.back()" class="btn btn-default">Back</a>

                                    <button style="color:white !important;" type="submit"
                                        @if ($user) onclick="updateStaff()" @else onclick="saveStaff()" @endif
                                        class="btn btn-primary btnSave pull-right">
                                        <span style="color:white !important;" class="indicator-label">
                                            @if ($user)
                                                Update
                                            @else
                                                Save
                                            @endif
                                        </span>
                                        <span style="color:white !important;" class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')
            <script src="{{ asset('assets/system/js/addForm.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
            <script type="text/javascript" language="javascript" class="init">
                $(".indicator-progress").toggle(false);

                $('#gender,#school_id,#roles').chosen({
                    width: "100%"
                });

                removeError();
                @if ($user)
                    function updateStaff() {
                        StaffData(true);
                    }
                @else
                    function saveStaff() {
                        StaffData(false);
                    }
                @endif

                function StaffData(isUpdate) {
                    $(".btnSave").prop('disabled', true);
                    $(".indicator-progress").toggle(true);
                    $(".indicator-label").hide();

                    var formData = new FormData();
                    formData.append('firstname', $("#firstname").val().trim());
                    formData.append('middlename', $("#middlename").val().trim());
                    formData.append('lastname', $("#lastname").val().trim());
                    formData.append('email', $("#email").val().trim());
                    formData.append('phone_number', $("#phone_number").val().trim());
                    formData.append('roles', $("#roles").val().trim());

                    if (isUpdate) {
                        formData.append('id', {!! isset($user) ? json_encode($user->id) : 'null' !!});

                        saveFormData("{{ route('staffs.update') }}", formData);
                    } else {
                        saveFormData("{{ route('staffs.store') }}", formData);
                    }
                }
            </script>
        @endpush
    @else
        @component('errors.unauthorized')
        @endcomponent
    @endif
@endsection
