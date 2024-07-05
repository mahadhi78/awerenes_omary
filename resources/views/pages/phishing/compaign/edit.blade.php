<div class="modal inmodal" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
            </div>
            <div class="modal-body bg-white"  id="edit_name_validate">
                <div class="form-group ">
                    <label for="edit_name" class="  font-weight-semibold">Name <span class="text-danger">*</span></label>

                    <input name="name" id="edit_name" type="text" class="form-control  @error('name') is-invalid @enderror"
                        placeholder="E.g. A1">
                </div>

                <div class="form-group " id="start_at_validate">
                    <label class="  font-weight-semibold">Start Date <span class="text-danger">*</span></label>

                    <input type="datetime-local" name="start_at" id="edit_start_at"
                        class="form-control @error('start_at') is-invalid @enderror">
                </div>

                <div class="form-group " id="end_at_validate">
                    <label for="end_at" class="  font-weight-semibold">End Date <span class="text-danger">*</span></label>

                    <input type="datetime-local" name="end_at" id="edit_end_at"
                        class="form-control @error('end_at') is-invalid @enderror">
                    
                </div>
                <div class="form-group" id="edit_status_validate">
                    <label for="edit_status" class=" font-weight-semibold">Status<span class="text-danger">*</span></label>

                    <select name="status" required id="edit_status"
                        class="form-control  @error('status') is-invalid @enderror">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button style="color:white !important;" type="submit" onclick="UpdateCompaign()"
                    class="btn btn-primary btnSave">
                    <span style="color:white !important;" class="indicator-label">Update</span>
                    <span style="color:white !important;" class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        </div>
    </div>
</div>
