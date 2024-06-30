<?php

namespace App\Http\Controllers\Reports;

use DOMDocument;
use Illuminate\Http\Request;
use App\Models\system\NewData;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Reports\ReportDaoImpl;

class NewsController extends Controller
{
    protected $report;
    public function __construct(ReportDaoImpl $report)
    {
        $this->report = $report;
        $this->middleware(['auth', 'prevent-back-history']);
    }

    public function index()
    {
        $d['news'] = $this->report->getNews();

        return view("pages.reports.news.index", $d);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), NewData::$rules);

            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->errors()];
            }

            // $data['description'] = $this->uploadBySummernote($data['description']);
            $file = $request->file('file');

            // Create a unique filename
            $filename = 'news_' . time() . '.json';

            // Save the file to the public/uploads directory
            $file->move(public_path('uploads'), $filename);
            $data['description'] = $filename;
            try {
                $school = $this->report->createNews($data);
                if ($school) {
                    $response = 'News Saved successfully';
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
        return response()->json($this->report->getNewsById($id));
    }
    public function getFileContents($id)
    {
        $upload = $this->report->getNewsById($id);
        $filePath = public_path('uploads/' . $upload->description);

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

    public function destroy($id)
    {
        //
    }
}
