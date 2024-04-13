<div class="modal inmodal" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
            </div>
            <div class="modal-body bg-white">
                <div class="form-group" id="fullname_validate">
                    <label for="fullname">
                        <span>Full Name <i class="text-danger">*</i></span>
                    </label>
                    <input type="text" readonly class="form-control form-control-solid"
                  name="fullname" id="fullname" />
                </div>
                
                <div class="form-group" id="level_id_validate">
                    <label for="level_id">
                        <span>Level <i class="text-danger">*</i></span>
                    </label>
                    <!--end::Label-->
                    {!! Form::select('level_id', $levels, null, [
                        'placeholder' => 'Please Select Here',
                        'class' => 'form-control ',
                        'required' => 'required',
                        'id' => 'level_id',
                        'onchange' => 'getSchools()',
                    ]) !!}
                </div>
                <div class="form-group" id="school_id_validate">
                    <label for="school_id">
                        <span>School Name <i class="text-danger">*</i></span>
                    </label>
                    <select onchange="getClass()" name="school_id" id="school_id" class="form-control">
                        <option value="">Select Level First</option>
                    </select>
                </div>
                <div class="form-group" id="class_id_validate">
                    <label for="class_id">
                        <span>Class Name <i class="text-danger">*</i></span>
                    </label>
                    <select name="class_id" id="class_id" class="form-control form-control-lg">
                        <option value="">Select School  First</option>
                    </select>
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
                <button style="color:white !important;" type="submit" onclick="AddApproveStudent()"
                    class="btn btn-primary btnSave">
                    <span style="color:white !important;" class="indicator-label">Save</span>
                    <span style="color:white !important;" class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        </div>
    </div>
</div>
