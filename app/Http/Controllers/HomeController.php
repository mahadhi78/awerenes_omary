<?php

namespace App\Http\Controllers;

use App\Helpers\Common;
use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Course\CourseDaoImpl;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Home\HomeDaoImpl;

class HomeController extends Controller
{
    protected $home, $course;

    public function __construct(HomeDaoImpl $home, CourseDaoImpl $course)
    {
        $this->home = $home;
        $this->course = $course;
        $this->middleware(['auth', 'prevent-back-history']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->userType == Constants::LEARNER) {
            return redirect()->route('learning.home');
        }
        $d['usersActive'] = $this->home->countStaff();

        return view('home', $d);
    }

    public function learning()
    {
        $d['usersActive'] = $this->home->countStaff();
        $d['topCourse'] = $this->course->fetchLastFiveData();

        return view('pages.Learn.home', $d);
    }


}
