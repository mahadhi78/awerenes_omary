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

            $data['description'] = $this->uploadBySummernote($data['description']);
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

    protected function uploadBySummernote($description)
    {
        $dom = new DOMDocument();
        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('imageFile');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData = base64_decode($data);
            $image_name = "/uploads/news" . time() . $item . '.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $imgeData);

            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }
        return $dom->saveHTML();
    }

    public function edit($id)
    {
        return response()->json($this->report->getNewsById($id));
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
