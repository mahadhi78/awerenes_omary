<div class="box-body bg-white">
    <div class="col-md-6 col-lg-6 col-sm-6">
        <div class="form-group" id="name_validate">
            <label for="name">
                <span> Name <i class="text-danger">*</i></span>
            </label>
            <input type="text" required class="form-control" placeholder="Enter Name" minlength="3" maxlength="250"
                name="name" id="name" value="@if ($faqs) {{ $faqs['name'] }} @endif" />
        </div>
    </div>
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="form-group" id="description_validate">
            <label for="description">
                <span> Description <i class="text-danger">*</i></span>
            </label>
            <textarea name="description" id="description" class="form-control" minlength="30" maxlength="300">
@if ($faqs)
{{ $faqs['description'] }}
@endif
</textarea>
        </div>
    </div>
</div>
<div class="box-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
    <button style="color:white !important;" type="submit" onclick="{{ $faqs ? 'updateFaqs()' : 'saveFaqs()' }}"
        class="btn btn-primary btnSave pull-right">
        <span style="color:white !important;" class="indicator-label">{{ $faqs ? 'Update' : 'Save' }}</span>
        <span style="color:white !important;" class="indicator-progress">Please wait...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
    </button>
</div>
