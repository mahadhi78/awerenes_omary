@extends('layouts.app')
@section('links')
    <link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
@endsection
@section('page_title', 'Leaner Registration')

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
                                    Leaner @if ($leaner)
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
                                                {!! Form::text('firstname', $leaner ? $leaner->firstname : '', [
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
                                                {!! Form::text('middlename', $leaner ? $leaner->middlename : '', [
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
                                                {!! Form::text('lastname', $leaner ? $leaner->lastname : '', [
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
                                            <div class="form-group" id="username_validate">
                                                <label for="username">UserName <i class="text-danger">*</i></label>
                                                {!! Form::text('username', $leaner ? $leaner->username : '', [
                                                    'placeholder' => 'Enter User Name',
                                                    'class' => 'form-control form-control-solid',
                                                    'autocomplete' => 'off',
                                                    'minLength' => 3,
                                                    'maxLength' => 30,
                                                    'id' => 'username',
                                                    $leaner ? 'readonly' : '',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="email_validate">
                                                <label for="email">Email <i class="text-danger">*</i></label>
                                                {!! Form::email('email', $leaner ? $leaner->email : '', [
                                                    'placeholder' => 'Enter Email',
                                                    'class' => 'form-control form-control-solid',
                                                
                                                    'autocomplete' => 'off',
                                                    'id' => 'email',
                                                    $leaner ? 'readonly' : '',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="password_validate">
                                                <label for="password">Password <i class="text-danger">*</i></label>
                                                <input type="password" required name="password" id="password"
                                                    class="form-control form-control-solid">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h3><i class="fa fa-info" aria-hidden="true"> password Rules </i></h3>

                                    </div>
                                    <div class="row col mt-3">
                                        <span>
                                            <ol>
                                                <li>Minimum Password Length should be 8 Characters</li>
                                                <li>Password must have Capital</li>
                                                <li>Password must have Small Letters</li>
                                                <li>Password must have Special Characters( <b
                                                        class="text-danger">$,&,@,#,*,&,(,),[,]</b> )</li>
                                            </ol>
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="box-footer">
                                    <a href="javascript:history.back()" class="btn btn-default">Back</a>

                                    <button style="color:white !important;" type="submit"
                                        @if ($leaner) onclick="updateStaff()" @else onclick="saveStaff()" @endif
                                        class="btn btn-primary btnSave pull-right">
                                        <span style="color:white !important;" class="indicator-label">
                                            @if ($leaner)
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
                @if ($leaner)
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
                    formData.append('username', $("#username").val().trim());
                    formData.append('email', $("#email").val().trim());
                    formData.append('password', $("#password").val().trim());

                    if (isUpdate) {
                        formData.append('id', {!! isset($leaner) ? json_encode($leaner->id) : 'null' !!});

                        saveFormData("{{ route('learners.update') }}", formData);
                    } else {
                        saveFormData("{{ route('learners.store') }}", formData);
                    }
                }
            </script>
        @endpush
    @else
        @component('errors.unauthorized')
        @endcomponent
    @endif
@endsection
