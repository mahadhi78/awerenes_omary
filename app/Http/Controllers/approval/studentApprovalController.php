<?php

namespace App\Http\Controllers\approval;

use App\Http\Controllers\Controller;
use App\Http\Controllers\levels\Dao\LevelDaoImpl;
use App\Http\Controllers\schools\Dao\SchoolDaoImpl;
use App\Http\Controllers\student\Dao\StudentDaoImpl;
use Illuminate\Http\Request;

class studentApprovalController extends Controller
{
    protected $student,$level;
    public function __construct(StudentDaoImpl $student,LevelDaoImpl $level)
    {
        $this->student = $student;
        $this->level = $level;
        $this->middleware(['auth', 'prevent-back-history']);
    }
    public function index()
    {
        $d['levels'] = $this->level->getAlevelByIdAndName();
        $d['student'] = $this->student->getUnApprovedStudents();
        return view('pages.approval.student.index', $d);
    }
    public function getstudent(Request $request)
    {
        return  $this->student->getStudentById($request->input('id'));
    }
}
