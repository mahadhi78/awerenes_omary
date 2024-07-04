<?php

namespace App\Http\Controllers\Reports;

use DOMDocument;
use App\Helpers\Common;
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
        $d['news_data'] = null;
        return view("pages.reports.news.index", $d);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), NewData::$rules);

            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->errors()];
            }

            $file = $request->file('file');
            $filename = 'news_' . time() . '.json';
            $fullPath = 'uploads/news';
            $file->move(public_path($fullPath), $filename);
            $data['description'] = $fullPath . '/' . $filename;
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
        $decodedId = Common::decodeHash($id);
        $d['news_data'] = $this->report->getNewsById($decodedId);
        $filePath = public_path($d['news_data']->description);
    
        if (file_exists($filePath)) {
            $content = json_decode(file_get_contents($filePath), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $d['news_data'] = $content;
            }
        }
        $d['news_data']['id'] = $decodedId;
        return view("pages.reports.news.edit", $d);

    }
    public function getFileContents($id)
    {
        $upload = $this->report->getNewsById($id);
        $filePath = public_path($upload->description);

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found.'], 404);
        }

        $contents = json_decode(file_get_contents($filePath), true);

        return response()->json($contents);
    }


    public function update(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), NewData::$rules);

            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->errors()];
            }
            $file = $request->file('file');
            $path = 'uploads/news/';
            $filename = 'news_' . time() . '.json';
            $file->move(public_path($path), $filename);
            $data['description'] = $path . $filename;
            
            try {
                $school = $this->report->updateNewsById($data['id'], $data);
                if ($school) {
                    $response = 'News Updated successfully';
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


    public function destroy(Request $request)
    {
        $class = $this->report->deleteNewsById($request['id']);
        try {
            $response = 'News Deleted Successfully';
            Log::channel('daily')->info($response . ' ' . $class);
            return ['success' => true, 'response' => $response];
        } catch (\Exception $error) {
            $response = 'Operation Failed,Please Contact System Administrator ' . $error;
            Log::channel('daily')->error($response . ' ' . $error->getMessage());
            return ['success' => 'failure', 'response' => $response];
        }
    }
}
