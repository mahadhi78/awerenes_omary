<div class="modal inmodal" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Add Section</h5>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    </div>
                </div>
            </div>
            <div class="modal-body bg-white">
                <div class="form-group" id="edit_level_id_validate">
                    <label for="edit_level_id">
                        <span>Level <i class="text-danger">*</i></span>
                    </label>
                    <!--end::Label-->
                    {!! Form::select('level_id', $levels, null, [
                        'placeholder' => 'Please Select Here',
                        'class' => 'form-control ',
                        'required' => 'required',
                        'id' => 'edit_level_id',
                        'onchange' => 'getSchoolsEdit()',
                    ]) !!}
                </div>
                <div class="form-group" id="edit_school_id_validate">
                    <label for="edit_school_id">
                        <span>School Name <i class="text-danger">*</i></span>
                    </label>
                    <select name="school_id" id="edit_school_id" class="form-control">
                        <option value="">Select Level First</option>
                    </select>
                </div>
                <div class="form-group" id="edit_name_validate">
                    <label for="edit_name">
                        <span>CLass Name <i class="text-danger">*</i></span>
                    </label>
                    <!--end::Label-->
                    <input type="text" required class="form-control form-control-solid" placeholder="Enter Name"
                        minlength="3" maxlength=250" name="name" id="edit_name" />
                </div>
                


                <div class="form-group" id="edit_status_validate">
                    <!--begin::Label-->
                    <label for="edit_status">
                        <span>Status<i class="text-danger">*</i></span>
                    </label>
                    <!--end::Label-->
                    <select name="status" required id="edit_status" class="form-control has-error">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button style="color:white !important;" type="submit" onclick="UpdateClass()"
                    class="btn btn-primary btnSave">
                    <span style="color:white !important;" class="indicator-label">Save</span>
                    <span style="color:white !important;" class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        </div>
    </div>
</div>
