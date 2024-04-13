<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
            </div>
            <div class="modal-body bg-white">

                <div class="row">
                    <div class="col-md-6">
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
                                'onchange' => 'getCourse(this.value)',
                            ]) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="course_id_validate">
                            <!--begin::Label-->
                            <label for="course_id">
                                <span>Course<i class="text-danger">*</i></span>
                            </label>
                            <select name="course_id" id="course_id" class="form-control">
                                <option value="">Select Level First</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="m_name_validate">
                    <label for="m_name">
                        <span>Module Name <i class="text-danger">*</i></span>
                    </label>
                    <input type="text" required class="form-control" placeholder="Enter Name" minlength="3"
                        maxlength="250" name="m_name" id="m_name" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button style="color:white !important;" type="submit" onclick="saveData()"
                    class="btn btn-primary btnSave">
                    <span style="color:white !important;" class="indicator-label">Save</span>
                    <span style="color:white !important;" class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        </div>
    </div>
</div>
