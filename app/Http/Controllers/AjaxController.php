<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Course\CourseDaoImpl;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    protected $course;
    public function __construct(CourseDaoImpl $course)
    {
        $this->course = $course;
        $this->middleware(['auth', 'prevent-back-history']);
    }

    public function get_course(Request $request)
    {
        return $this->course->ajaxCourseByLevelId($request->get('level_id'));
    }

    public function get_module(Request $request)
    {
        return $this->course->ajaxModuleByCourseId($request->get('course_id'));

    }
}
