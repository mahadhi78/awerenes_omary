<div class="card-body">
    <form enctype="multipart/form-data" method="post" action="{{ route('settings.update') }}">
        @csrf @method('PUT')
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group ">
                    <label for="system_name">System Name <span class="text-danger">*</span></label>
                    <input id="system_name" name="system_name" value="{{ $s['system_name'] }}" type="text"
                        class="form-control " placeholder="Name of School">
                      
                </div>
                <div class="form-group">
                    <label for="system_title">System Title</label>
                    <input id="system_title" name="system_title" @if (Auth::user()->can('settings-edit')) @else readonly @endif
                        value="{{ $s['system_title'] }}" type="text" class="form-control"
                        placeholder="School Acronym">
                </div>
                 
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input autocomplete="false" id="phone" name="phone"
                        @if (Auth::user()->can('settings-edit')) @else readonly @endif value="{{ $s['phone'] }}"
                        type="text" class="form-control" placeholder="Phone">
                </div>
                <div class="form-group">
                    <label for="system_email">System Email</label>
                    <input id="system_email" name="system_email" @if (Auth::user()->can('settings-edit')) @else readonly @endif
                        value="{{ $s['system_email'] }}" type="email" class="form-control" placeholder="School Email">
                </div>
                <div class="form-group">
                    <label for="address">System Address <span class="text-danger">*</span></label>
                    <input autocomplete="false" required id="address" name="address"
                        @if (Auth::user()->can('settings-edit')) @else readonly @endif value="{{ $s['address'] }}"
                        type="text" class="form-control" placeholder="School Address">
                </div>
            </div>


            

        <hr class="divider">

        <div class="box-footer">
            <a href="javascript:history.back()" class="btn btn-default">Back</a>
            @if (Auth::user()->can('settings-edit'))
                <button type="submit" class="btn btn-primary pull-right ">
                    <i class="fa fa-send"> Update </i>

                </button>
            @endif
        </div>
    </form>
</div>
