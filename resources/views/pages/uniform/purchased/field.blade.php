<div class="box-body">
    <h3><i class="fa fa-info" aria-hidden="true"> Academic info </i></h3>

    <div class="row mt-2">
        <div class="col-md-4">
            <div class="fom-group" id="uniform_category_id_validate">
                <label for="uniform_category_id">
                    <span>Uniform Category <i class="text-danger">*</i></span>
                </label>
                {{-- {!! Form::select('uniform_category_id', $unifromcategoryList, null, [
                    'placeholder' => 'Please Select Here',
                    'class' => 'form-control form-control-solid form-select',
                    'required' => 'required',
                    'id' => 'uniform_category_id',
                ]) !!} --}}

            </div>
        </div>

        <div class="col-md-4">
            <div class="fom-group" id="qty_validate">
                <label for="qty">
                    <span>Quantity <i class="text-danger">*</i></span>
                </label>
                <input type="number" required class="form-control form-control-solid" placeholder="Enter Quantity"
                    minlength="1" maxlength="50" name="qty" id="qty" />
            </div>
        </div>
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
        @if (Auth::user()->school_id == null)
            <div class="col-md-4">
                <div class="fom-group">
                    <label for="school_id">
                        <span>School Name <i class="text-danger">*</i></span>
                    </label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-building"></i></span>
                        {{-- {!! Form::select('school_id', $schools, null, [
                            'placeholder' => 'Please Select Here',
                            'class' => 'form-control form-control-solid form-select',
                            'required' => 'required',
                            'id' => 'school_id',
                        ]) !!} --}}

                    </div>
                </div>
            </div>
        @else
            <input hidden readonly required class="form-control form-control-solid" value="{{ Auth::user()->school_id }}"
                name="school_id" id="school_id" />
        @endif

    </div>


</div>

<hr class="divider">
<div class="text-center">
    <button style="color:white !important;" type="submit" onclick="savePublishedUniform()"
        class="btn btn-primary btnSave">
        <span style="color:white !important;" class="indicator-label">Save</span>
        <span style="color:white !important;" class="indicator-progress">Please wait...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
    </button>
</div>
