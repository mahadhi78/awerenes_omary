@extends('layouts.app')
@section('page_title', 'Subject')

@section('content')
    @if (Gate::check('roles-save'))
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()"
                                    class="btn btn-default  fa fa-arrow-circle-left"></a>&nbsp;&nbsp;
                                <h4>
                                    Role @if ($role)
                                        {{ $role->name }}
                                    @endif
                                    <small>
                                        @if ($role)
                                            Update
                                        @else
                                            Add New
                                        @endif
                                    </small>
                                </h4>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form novalidate id="entryForm"
                                action="@if ($role) {{ URL::Route('roles.update', $role->id) }} @else {{ URL::Route('roles.store') }} @endif"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="box-body">
                                    @if (!$role)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label for="name">Role Name<span
                                                            class="text-danger">*</span></label>
                                                    <input autofocus type="text" id="name" class="form-control"
                                                        name="name" placeholder="name" value="{{ old('name') }}"
                                                        required minlength="4" maxlength="255" autocomplete="on">
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label for="status">Status<span class="text-danger">*</span></label>
                                                    <select name="status" required id="status" class="form-control">
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>
                                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <h4>Permissions</h4>
                                    @foreach ($permissionList as $group => $modules)
                                        <p class="lead section-title">{{ $group }}:</p>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>

                                                            <th width="30%">Module Name</th>
                                                            <th>Create</th>
                                                            <th>View</th>
                                                            <th>Edit</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($modules as $module => $verbs)
                                                            <tr>
                                                                <td>
                                                                    {{ $module }}
                                                                </td>
                                                                <td>
                                                                    @if (isset($verbs['Save']))
                                                                        <input type="checkbox" class="checkbox"
                                                                            name="permissions[]"
                                                                            value="{{ implode(',', $verbs['Save']['ids']) }}"
                                                                            @if ($verbs['Save']['checked']) checked @endif>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (isset($verbs['List']))
                                                                        <input type="checkbox" class="checkbox"
                                                                            name="permissions[]"
                                                                            value="{{ implode(',', $verbs['List']['ids']) }}"
                                                                            @if ($verbs['List']['checked']) checked @endif>
                                                                    @endif

                                                                </td>
                                                                <td>
                                                                    @if (isset($verbs['Edit']))
                                                                        <input type="checkbox" class="checkbox"
                                                                            name="permissions[]"
                                                                            value="{{ implode(',', $verbs['Edit']['ids']) }}"
                                                                            @if ($verbs['Edit']['checked']) checked @endif>
                                                                    @endif

                                                                </td>

                                                                <td>
                                                                    @if (isset($verbs['Delete']))
                                                                        <input type="checkbox" class="checkbox"
                                                                            name="permissions[]"
                                                                            value="{{ implode(',', $verbs['Delete']['ids']) }}"
                                                                            @if ($verbs['Delete']['checked']) checked @endif>
                                                                    @endif

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="box-footer">
                                    <a href="javascript:history.back()" class="btn btn-default">Back</a>
                                    <button type="submit" class="btn btn-info pull-right"><i
                                            class="fa @if ($role) fa-refresh @else fa-plus-circle @endif"></i>
                                        @if ($role)
                                            Update
                                        @else
                                            Add
                                        @endif
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('.tableCheckedAll').on('change', function() {
                        $(this).closest('table').find('.checkbox').prop('checked', this.checked);
                    });
                    $('.rowCheckedAll').on('change', function() {
                        $(this).closest('tr').find('.checkbox').prop('checked', this.checked);
                    });
                });
            </script>
        @endpush
    @else
        @component('errors.unauthorized')
        @endcomponent
    @endif
@endsection
