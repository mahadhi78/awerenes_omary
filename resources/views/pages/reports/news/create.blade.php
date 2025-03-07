<div class="mt-2">

    <div class="col-md-12">

        <div class="box-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="new_name_validate">
                        <label for="new_name"> Name <span class="text-danger">*</span></label>
                        <input type='text' class="form-control @error('new_name') is-invalid @enderror"
                            name="new_name" id="new_name" placeholder="News  " value="@if ($news_data) {{ $news_data['new_name'] }} @endif" />
                        @error('new_name')
                            <span class="invalid-feedback">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group" id="description_validate">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                            minlength="30" maxlength="500">@if ($news_data){{ $news_data['description'] }}@endif</textarea>
                        @error('description')
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

            <button style="color:white !important;" type="submit" onclick="{{ $news_data ? 'updateData()' : 'saveData()' }}"
                class="btn btn-primary btnSave pull-right">
                <span style="color:white !important;" class="indicator-label">{{ $news_data ? 'Update' : 'Save' }}</span>
                <span style="color:white !important;" class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </div>

</div>
