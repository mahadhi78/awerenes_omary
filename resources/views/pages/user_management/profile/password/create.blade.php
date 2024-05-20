<form action="" method="post">
    @csrf
    <div class="box-body ">
        <div class="row mb-3">
            <label for="old_password" class="col-md-2 col-form-label ">Previous Password:</label>

            <div class="col-md-6">
                <input type="password" required class="form-control " placeholder="Enter Previous Password"
                    name="old_password" id="old_password" autocomplete="off" />
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="password" class="col-md-2 col-form-label "> Password:</label>

            <div class="col-md-6">
                <input type="password" required class="form-control " minLength="8" placeholder="Enter Password"
                    name="password" id="password" autocomplete="off" />
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="password_confirmation" class="col-md-2 col-form-label ">Confirm Password:</label>

            <div class="col-md-6">
                <input type="password" required class="form-control " placeholder="Enter Confirmation Password"
                    name="password_confirmation" minLength="8" autocomplete="off" id="password_confirmation" />
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button style="color:white !important;" type="submit" id="changePasswordBtn" onclick="updateForm()"
                    class="btn btn-primary btnSave">
                    <span style="color:white !important;" class="indicator-label">Change Password</span>
                    <span style="color:white !important;" class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        </div>

    </div>

</form>
<div class="col-md-6">
    <h3><i class="fa fa-info" aria-hidden="true"> Change password Rules </i></h3>

</div>
<div class="row">
    <span>
        <ol>
            <li>Minimum Password Length should be 8 Characters</li>
            <li>Password must have Capital</li>
            <li>Password must have Small Letters</li>
            <li>Password must have Special Characters( <b class="text-danger">$,&,@,#,*,&,(,),[,]</b> )</li>
        </ol>
    </span>
</div>
