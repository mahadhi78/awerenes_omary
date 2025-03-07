<div class="modal inmodal" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Edit Course</h5>
            </div>
            <div class="modal-body bg-white">
                <div class="form-group" id="edit_c_name_validate">
                    <label for="edit_c_name">
                        <span>Course Name <i class="text-danger">*</i></span>
                    </label>
                    <input type="text" required class="form-control" placeholder="Enter Name" minlength="3"
                        maxlength="250" name="c_name" id="edit_c_name" />
                </div>
                <div class="row">
                    <div class="col-md-6">
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
                            ]) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="edit_c_logo_validate">
                            <!--begin::Label-->
                            <label for="edit_c_logo">
                                <span>Logo<i class="text-danger">*</i></span>
                            </label>
                            <input type="file" name="c_logo" id="edit_c_logo" class="form-control"
                                accept="image/png,image/jpeg">
                        </div>
                    </div>
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
