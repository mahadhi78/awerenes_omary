<div class="box-body">
    <h3><i class="fa fa-info" aria-hidden="true"> Academic info </i></h3>

    <div class="row mt-2">
        @if (Auth::user()->school_id == null)
            <div class="col-md-4">
                <div class="fom-group" id="school_id_validate">
                    <label for="school_id">
                        <span>School Name <i class="text-danger">*</i></span>
                    </label>
                    {!! Form::select('school_id', $schools, null, [
                        'placeholder' => 'Please Select Here',
                        'class' => 'form-control form-control-solid form-select',
                        'required' => 'required',
                        'id' => 'school_id',
                    ]) !!}
                </div>
            </div>
        @else
            <input hidden readonly required class="form-control form-control-solid" value="{{ Auth::user()->school_id }}"
                name="school_id" id="school_id" />
        @endif
        <div class="col-md-4">
            <div class="fom-group" id="uniform_type_id_validate">
                <label for="uniform_type_id">
                    <span>Uniform Type <i class="text-danger">*</i></span>
                </label>
                {!! Form::select('uniform_type_id', $unTypeList, null, [
                    'placeholder' => 'Please Select Here',
                    'class' => 'form-control form-control-solid form-select',
                    'required' => 'required',
                    'id' => 'uniform_type_id',
                    'onchange' => 'getUniformCategory()',
                ]) !!}

            </div>
        </div>

        {{-- <div class="col-md-4">
            <div class="fom-group" id="qty_validate">
                <label for="qty">
                    <span>Quantity <i class="text-danger">*</i></span>
                </label>
                <input type="number" required class="form-control form-control-solid" placeholder="Enter Quantity"
                    minlength="1" maxlength="50" name="qty" id="qty" />
            </div>
        </div> --}}
        <div class="col-md-4">
            <div class="fom-group" id="pub_date_validate">
                <label for="pub_date">
                    <span>Date <i class="text-danger">*</i></span>
                </label>
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input name="pub_date" id="pub_date" type="text" class="form-control" placeholder="YYYY-MM-DD"
                        readonly value="<?php echo date('d/m/Y'); ?>">

                </div>
            </div>
        </div>


    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <!-- Initially hidden table -->
            <table class="table table-bordered" id="data-table" style="display: none">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Quantity </th>
                        <th class="d-none">ID</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <!-- Data will be inserted here -->
                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="box-footer">
    <hr>
    <a href="javascript:history.back()" class="btn btn-default">Back</a>
    <button style="color:white !important;" type="submit" onclick="savePublishedUniform()"
        class="btn btn-primary btnSave pull-right">
        <i class="fa fa-plus"></i>
        <span style="color:white !important;" class="indicator-label">Save</span>
        <span style="color:white !important;" class="indicator-progress">Please wait...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
    </button>
</div>
