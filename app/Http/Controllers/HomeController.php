<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Course\CourseDaoImpl;
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
        $data = $this->report->getNews()->take(5);

        $news = [];
        foreach ($data as $item) {
            $filePath = public_path($item->description);
            $content = json_decode(file_get_contents($filePath), true);
            $content['id'] = $item->id;
            $news[] = $content;
        }
        $d['news'] = $news;
        
        return view('home', $d);
    }
}
