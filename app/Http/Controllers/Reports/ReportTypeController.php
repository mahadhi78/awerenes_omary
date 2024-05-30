<?php

namespace App\Http\Controllers\Reports;


use App\Helpers\Common;
use App\Constants\Constants;
use Illuminate\Http\Request;
use App\Models\system\Courses;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Reports\ReportDaoImpl;
use App\Models\system\ReportType;

class ReportTypeController extends Controller
{
    protected $report;
    public function __construct(ReportDaoImpl $report)
    {
        $this->report = $report;
        $this->middleware(['auth', 'prevent-back-history']);
    }

    public function index()
    {
        $d['type'] = $this->report->getType();
        if (Auth::user()->userType == Constants::LEARNER) {
            return view('pages.Learn.course.index', $d);
        }
        return view("pages.reports.type.index", $d);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), ReportType::$rules);

            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->errors()];
            }

            $schoolExists =  $this->report->getTypeData([
                ['name',$data['name']],
                ['status',Constants::STATUS_ACTIVE]
            ])->first();
            if ($schoolExists) {
                $response = 'Type: ' . $data['name'] . ' already exists';
                return ['success' => 'failure', 'response' => $response];
            }

            try {
                $school = $this->report->createType($data);
                if ($school) {
                    $response = 'Type saved successfully';
                    Log::channel('daily')->info($response . ': ' . $school);
                    return ['success' => true, 'response' => $response];
                }
            } catch (\Exception $error) {
                $response = 'Operation failed, please contact the system administrator: ' . $error->getMessage();
                Log::channel('daily')->error($response);
                return ['success' => 'failure', 'response' => $response];
            }
        }
    }


    public function coursePreview($id)
    {
        $id = Common::decodeHash($id);
        $d['course'] = $this->course->getCourseById($id)->c_name;
        $d['modules'] = $this->course->getModuleByCourseId($id);
        if (Auth::user()->userType == Constants::LEARNER) {
            return view('pages.Learn.course.preview', $d);
        }
        return view("pages.C_M_L_manage.course.preview.index", $d);
        //
    }



    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
