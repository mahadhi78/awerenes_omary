<?php

namespace App\Http\Controllers\Reports;


use App\Helpers\Common;
use App\Constants\Constants;
use Illuminate\Http\Request;
use App\Models\system\Report;
use App\Models\system\Courses;
use App\Models\system\ReportType;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Reports\ReportDaoImpl;
use DOMDocument;

class ReportController extends Controller
{
    protected $report;
    public function __construct(ReportDaoImpl $report)
    {
        $this->report = $report;
        $this->middleware(['auth', 'prevent-back-history']);
    }

    public function index()
    {
        $query = $this->report->getReport();
        if (Auth::user()->userType == Constants::LEARNER) {
            $query = $query->where('user_id', Auth::user()->id);
        }
        $d['report'] = $query;
        return view("pages.reports.feedback.index", $d);
    }

    public function create($id = null)
    {
        $d['type'] = $this->report->getType();

        if ($id) {

            $data = $this->report->getReportById(Common::decodeHash($id));
            $filePath = $data->description;

            if (!file_exists($filePath)) {
                return response()->json(['error' => 'File not found.'], 404);
            }
            $d['data'] = json_decode(file_get_contents($filePath), true);
            $d['type_data'] = $data;

        }
        $d['data'] = null;
        return view("pages.Learn.report.create", $d);
    }



    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), Report::$rules);

            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->errors()];
            }


            $file = $request->file('file');
            $filename = 'report_' . time() . '.json';
            $fullPath = 'uploads/reports';
            $file->move(public_path($fullPath), $filename);
            $data['description'] = $fullPath . '/' . $filename;

            $data['user_id'] = Auth::user()->id;
            try {
                $school = $this->report->createReport($data);
                if ($school) {
                    $response = 'Report Send successfully';
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



    public function edit($id)
    {
        $upload = $this->report->getReportById($id);
        $filePath = public_path($upload->description);
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found.'], 404);
        }
        $contents = json_decode(file_get_contents($filePath), true);
        return response()->json($contents);
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        $class = $this->report->deleteReportById($request['id']);
        try {
            $response = 'Data Deleted Successfully';
            Log::channel('daily')->info($response . ' ' . $class);
            return ['success' => true, 'response' => $response];
        } catch (\Exception $error) {
            $response = 'Operation Failed,Please Contact System Administrator ' . $error;
            Log::channel('daily')->error($response . ' ' . $error->getMessage());
            return ['success' => 'failure', 'response' => $response];
        }
    }
}
