<?php

namespace App\Http\Controllers;

use App\Helpers\Common;
use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Course\CourseDaoImpl;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Home\HomeDaoImpl;
use App\Http\Controllers\Reports\ReportDaoImpl;

class HomeController extends Controller
{
    protected $home, $course, $report;

    public function __construct(HomeDaoImpl $home, CourseDaoImpl $course, ReportDaoImpl $report)
    {
        $this->home = $home;
        $this->course = $course;
        $this->report = $report;
        $this->middleware(['auth', 'prevent-back-history']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $d['usersActive'] = $this->home->countStaff();
        $d['studentActive'] = $this->home->countStudents();
        $d['courseCount'] = $this->home->countCourse();
        $d['templateCount'] = $this->home->templateCount();
        $d['topCourse'] = $this->course->fetchLastFiveData();
        $d['news'] = $this->report->getNews()->take(5);

        return view('home', $d);
    }
}
