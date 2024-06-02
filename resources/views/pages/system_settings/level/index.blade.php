@extends('layouts.app')
@section('page_title', 'Levels')

@section('content')
    @if (Gate::any(['levels-list', 'levels-edit']))
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()" class="btn btn-default  fa fa-arrow-circle-left"></a>
                                <h4>levels Management</h4>
                                @can('levels-save')
                                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                                        data-target="#myModal">
                                        <i class="fa fa-plus"></i>
                                        Add level</a>
                                    </button>
                                    @include('pages.system_settings.level.create')
                                @endcan
                            </div>
                        </div>
                        <div class="ibox-content">
                            @include('pages.system_settings.level.table')
                            @include('pages.system_settings.level.edit')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            <script src="{{ asset('assets/forms/js/form_sweetAlert.js') }}"></script>
            <script src="{{ asset('assets/system/js/addForm.js') }}"></script>

            <script type="text/javascript" language="javascript" class="init">
                $(".indicator-progress").toggle(false);

                $('#level_id').chosen({
                    width: "100%"
                });

                removeError();

                function saveData() {
                    $(".btnSave").prop('disabled', true);
                    $(".indicator-progress").toggle(true);
                    $(".indicator-label").hide();

                    var formData = new FormData()
                    formData.append('lv_name', $("#lv_name").val().trim());

                    var formActionUrl = "{{ route('levels.save') }}";
                    saveFormData(formActionUrl, formData);
                }

                var levelId = null;

                function editData(id) {
                    var url = "{{ route('levels.edit', ':id') }}";
                    url = url.replace(':id', id);
                    $.ajax({
                        type: 'GET',
                        url: url,
                        success: function(response) {
                            $('#edit_lv_name').val(response.lv_name);
                            levelId = id
                            $('#editModal').modal('show');
                        }
                    });
                }

                function updateSchool() {
                    $(".btnSave").prop('disabled', true);
                    $(".indicator-progress").toggle(true);
                    $(".indicator-label").hide();

                    var formData = new FormData()
                    formData.append('lv_name', $("#edit_lv_name").val().trim());
                    formData.append('id', levelId);

                    var formActionUrl = "{{ route('levels.update') }}";
                    UpdateData(formActionUrl, formData);
                }

                function deleteLevel(id) {
                    var formData = new FormData()
                    formData.append('id', id);
                    var url = "{{ route('levels.destroy') }}";
                    deleteData(formData, url);
                }
            </script>
            {!! Common::renderDataTable() !!}
        @endpush
    @else
        @component('errors.unauthorized')
        @endcomponent
    @endif
@endsection
