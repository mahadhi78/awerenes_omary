<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Level\LevelDaoImpl;
use App\Http\Controllers\Course\CourseDaoImpl;

class HomeFController extends Controller
{
    protected $course, $level;
    public function __construct(CourseDaoImpl $course, LevelDaoImpl $level)
    {
        $this->course = $course;
        $this->level = $level;
    }

    public function index()
    {
        $d['course'] = $this->course->getCourse();

        return view('frontend.home',$d);
    }

    public function contact(Request $request)
    {
        $d['course'] = $this->course->getCourse();

        return view('frontend.contact',$d);

    }

    public function about(Request $request)
    {

    }
    public function courses(Request $request)
    {
        
    }
}
