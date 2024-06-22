<div class="mt-2">

    <div class="col-md-12">
        <form novalidate id="entryForm" action="{{ route('template.save') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="box-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" id="lesson_name_validate">
                            <label for="temp_name"> Name <span class="text-danger">*</span></label>
                            <input type='text' class="form-control @error('temp_name') is-invalid @enderror"
                                name="temp_name" id="temp_name" placeholder="Lesson  " />
                            @error('temp_name')
                                <span class="invalid-feedback">
                                    <p>{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group" id="info_validate">
                            <label for="info">Description</label>

                            <textarea name="info" id="info" class="form-control @error('info') is-invalid @enderror" minlength="30"
                                maxlength="300"><p><a href="" target="_blank"> Enter Face Link</a><br></p></textarea>
                            @error('info')
                                <span class="invalid-feedback">
                                    <p>{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="box-footer">
                <hr>
                <a href="javascript:history.back()" class="btn btn-default">Back</a>

                <button style="color:white !important;" type="submit" onclick="saveLesson()"
                    class="btn btn-primary btnSave pull-right">
                    <span style="color:white !important;" class="indicator-label">Save</span>
                    <span style="color:white !important;" class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        </form>
    </div>

</div>
