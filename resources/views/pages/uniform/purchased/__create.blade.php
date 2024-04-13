<div class="modal modal fade " id="kt_modal_uniform_Purchased">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white border-accent-thin">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body ">

                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span>Uniform Type <i class="redStar">*</i></span>
                    </label>
                    <!--end::Label-->
                    {{-- {!! Form::select('uniform_category_id', $unifromcategoryList, null, [
                        'placeholder' => 'Please Select Here',
                        'class' => 'form-control form-control-solid form-select',
                        'required' => 'required',
                        'id' => 'uniform_category_id',
                    ]) !!} --}}

                </div><br>
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span>Type <i class="redStar">*</i></span>
                    </label>
                    <!--end::Label-->
                    <input type="number" required class="form-control form-control-solid" placeholder="Enter Quantity"
                        minlength="1" maxlength="50" name="qty" id="qty" />
                </div><br>



            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button style="color:white !important;" type="submit" onclick="savePurchasedUniform()"
                    class="btn btn-primary btnSave">
                    <span style="color:white !important;" class="indicator-label">Save</span>
                    <span style="color:white !important;" class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                </button>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('system/js/addForm.js') }}"></script>
    <script type="text/javascript" language="javascript" class="init">
        function savePurchasedUniform() {
            $(".btnSave").prop('disabled', true);
            $(".indicator-progress").toggle(true);
            $(".indicator-label").hide();

            var uniform_category_id = $("#uniform_category_id").val();
            var qty = $("#qty").val();


            if (uniform_category_id == "") {
                $(".btnSave").prop('disabled', false);
                $(".indicator-progress").toggle(false);
                $(".indicator-label").show();
                swal("select Uniform Type");
                return false;
            }
            if (qty == "") {
                $(".btnSave").prop('disabled', false);
                $(".indicator-progress").toggle(false);
                $(".indicator-label").show();
                swal("Please Enter Quantity");
                return false;
            }

            var formData = new FormData()
            formData.append('uniform_category_id', uniform_category_id.trim());
            formData.append('qty', qty.trim());
            
            var formActionUrl = "{{ route('uniforms.createPublished') }}";
            saveFormData(formActionUrl,formData);
           
        }
    </script>
@endpush
