<div class="modal inmodal" id="editUserProfilePhoto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body bg-white">
                <div class="form-group" id="status_validate">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Upload Photo</span>
                        </label>
                        <!--end::Label-->
                        <input type="file" required class="form-control form-control-solid"
                            placeholder="Upload Photo" autocomplete="off" name="photo_url" id="photo_url" accept="image/png,image/jpeg" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button style="color:white !important;" id="editUserProfilePhotoBtn" type="submit"
                    onclick="updateProfilePhotoForm()" class="btn btn-primary btnSave">
                    <span style="color:white !important;" class="indicator-label">Upload</span>
                    <span style="color:white !important;" class="indicator-progress">Please
                        wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        </div>
    </div>
</div>
