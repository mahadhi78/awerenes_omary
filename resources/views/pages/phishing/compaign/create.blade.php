<div class="mt-2">

    <div class="col-md-8">
        <form method="post" action="{{ route('compaign.save') }}">
            @csrf
            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">Name <span
                        class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input name="name"  type="text"
                        class="form-control  @error('name') is-invalid @enderror" placeholder="E.g. A1">
                    @error('name')
                        <span class="invalid-feedback">
                            <p>{{ $message }}</p>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">Start Date <span
                        class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input type="datetime-local" name="start_at" id="start_at"
                        class="form-control @error('start_at') is-invalid @enderror">
                    @error('start_at')
                        <span class="invalid-feedback">
                            <p>{{ $message }}</p>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">End Date <span
                        class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input type="datetime-local" name="end_at" id="end_at"
                        class="form-control @error('end_at') is-invalid @enderror">
                    @error('end_at')
                        <span class="invalid-feedback">
                            <p>{{ $message }}</p>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">Status<span
                        class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <select name="status" required id="status"
                        class="form-control  @error('status') is-invalid @enderror">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    @error('status')
                        <span class="invalid-feedback">
                            <p>{{ $message }}</p>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Submit <i class=" fa fa-save ml-2"></i></button>
            </div>
        </form>
    </div>

</div>
