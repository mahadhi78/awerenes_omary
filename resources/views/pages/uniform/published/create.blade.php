@extends('layouts.app')
@section('links')
    <link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
@endsection
@section('page_title', 'Uniform Published')

@section('content')
    @if (Gate::check('uniforms_published-save'))
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()"
                                    class="btn btn-default  fa fa-arrow-circle-left"></a>&nbsp;&nbsp;
                                <h4>Add Published Uniform</h4>
                            </div>
                        </div>
                        <div class="ibox-content">
                            @include('pages.uniform.published.create_published')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @component('errors.unauthorized')
        @endcomponent
    @endif
    @push('scripts')
        <script src="{{ asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

        <script src="{{ asset('system/js/addForm.js') }}"></script>
        <script type="text/javascript" language="javascript" class="init">
            $(".indicator-progress").toggle(false);

            $('#uniform_type_id,#school_id').chosen({
                width: "100%"
            });
            $('#pub_date_validate .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            function getUniformCategory() {
                var uniform_type_id = document.getElementById("uniform_type_id").value;
                var formData = new FormData()
                formData.append('uniform_type_id', uniform_type_id);
                var url = "{{ route('uniform.getCategory') }}";
                makeAjaxRequest(url, formData, getUniformCategoryCreate)
            }

            function getUniformCategoryCreate(data) {
                // console.log(data);
                var table = document.getElementById("data-table");
                var tableBody = document.getElementById("table-body");

                tableBody.innerHTML = "";

                if (data && data.length > 0) {
                    table.style.display = "table";

                    data.forEach(function(item) {
                        var row = tableBody.insertRow();
                        var nameCell = row.insertCell(0);
                        var actionCell = row.insertCell(1);
                        var idCell = row.insertCell(2);

                        idCell.innerHTML = `<span class="d-none data-id">${item.id}</span>`;
                        nameCell.innerHTML = item.category_name;

                        var userInput = document.createElement("input");
                        userInput.type = "text";
                        userInput.classList.add("form-control");
                        userInput.name = "qty";
                        actionCell.appendChild(userInput);
                    });
                } else {
                    table.style.display = "none";
                }
            }

            function collectDataToSave() {
                var dataToSave = [];
                var tableBody = document.getElementById("table-body");
                var rows = tableBody.getElementsByTagName("tr");
                for (var i = 0; i < rows.length; i++) {
                    var row = rows[i];
                    var id = row.querySelector('.data-id').textContent.trim();
                    var qty = row.cells[1].querySelector("input"); // Get the user input field
                    dataToSave.push({
                        uniform_category_id: id,
                        qty: qty.value
                    });
                }
                return dataToSave;
            }

            function savePublishedUniform() {
                $(".btnSave").prop('disabled', true);
                $(".indicator-progress").toggle(true);
                $(".indicator-label").hide();
                var data = collectDataToSave();

                var pub_date = $("#pub_date").val();
                var school_id = $("#school_id").val();

                var formData = new FormData()
                formData.append('pub_date', pub_date.trim());
                formData.append('school_id', school_id.trim());
                formData.append('data', JSON.stringify(data));


                var formActionUrl = "{{ route('uniforms_published.save') }}";
                if (data == '') {
                    swal('select Uniform Type & Add Details', {
                        icon: "warning",
                    }).then((m) => {
                        $(".btnSave").prop("disabled", false);
                        $(".indicator-progress").toggle(false);
                        $(".indicator-label").show();
                    });
                } else {

                    saveFormData(formActionUrl, formData);
                }

            }
        </script>
    @endpush
@endsection
