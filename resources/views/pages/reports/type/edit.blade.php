<div class="modal inmodal" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
            </div>
            <div class="modal-body bg-white">
                <div class="form-group" id="edit_name_validate">
                    <label for="edit_name">
                        <span> Name <i class="text-danger">*</i></span>
                    </label>
                    <input type="text" required class="form-control" placeholder="Enter Name" minlength="3"
                        maxlength="250" name="name" id="edit_name" />
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
                <button style="color:white !important;" type="submit" onclick="UpdateType()"
                    class="btn btn-primary btnSave">
                    <span style="color:white !important;" class="indicator-label">Save</span>
                    <span style="color:white !important;" class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        </div>
    </div>
</div>
