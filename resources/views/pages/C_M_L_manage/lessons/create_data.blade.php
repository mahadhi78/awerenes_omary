<form novalidate id="entryForm" action="" method="post" enctype="multipart/form-data">
    @csrf
    <div class="box-body">

        <div class="row">
            <div class="col-md-3">
                <div class="form-group" id="lesson_name_validate">
                    <label for="lesson_name"> Title<span class="text-danger">*</span></label>
                    <input type='text' class="form-control " name="lesson_name" id="lesson_name"
                        placeholder="Lesson  "
                        value="@if ($lesson) {{ $lesson->lesson_name }} @endif" />
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group" id="level_id_validate">
                    <label for="level_id">
                        <span>Level <i class="text-danger">*</i></span>
                    </label>
                    <!--end::Label-->
                    {!! Form::select('level_id', $levels, $selected_level_id, [
                        'placeholder' => 'Please Select Here',
                        'class' => 'form-control ',
                        'required' => 'required',
                        'id' => 'level_id',
                        'onchange' => 'getCourse(this.value)',
                    ]) !!}
                </div>

            </div>
            <div class="col-md-3">
                <div class="form-group" id="course_id_validate">
                    <!--begin::Label-->
                    <label for="course_id">
                        <span>Course<i class="text-danger">*</i></span>
                    </label>
                    <select name="course_id" id="course_id" class="form-control" onchange="getModules(this.value)">
                        <option value="">Select Level First</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group" id="module_id_validate">
                    <!--begin::Label-->
                    <label for="module_id">
                        <span>Module<i class="text-danger">*</i></span>
                    </label>
                    <select name="module_id" id="module_id" class="form-control">
                        <option value="">Select Course First</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group" id="description_validate">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" minlength="30" maxlength="300">
@if ($lesson_data)
{{ $lesson_data['description'] }}
@endif
</textarea>
                </div>
            </div>
        </div>

    </div>
    <div class="box-footer">
        <hr>
        <a href="javascript:history.back()" class="btn btn-default">Back</a>

        <button style="color:white !important;" type="submit"
            @if ($lesson) onclick="updateLesson()" @else onclick="saveLesson()" @endif
            class="btn btn-primary btnSave pull-right">
            <span style="color:white !important;" class="indicator-label">
                @if ($lesson)
                    Update
                @else
                    Save
                @endif
            </span>
            <span style="color:white !important;" class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
</form>
