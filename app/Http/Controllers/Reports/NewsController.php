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
        $validator = Validator::make($data = $request->all(), NewData::$rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $data['description'] = $this->uploadBySummernote($data['description']);
        try {
            $news = NewData::create($data);
            if ($news) {
                $response = 'News Saved successfully';
                Log::channel('daily')->info($response . ': ' . $news);
                    return ['success' => true, 'response' => $response];
            }
        } catch (\Exception $error) {
            $response = 'Operation failed, please contact the system administrator: ' . $error->getMessage();
            Log::channel('daily')->error($response);
                return ['success' => 'failure', 'response' => $response];
        }
    }

    protected function uploadBySummernote($description)
    {
        $dom = new \DomDocument();
        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFiles = $dom->getElementsByTagName('img');

        foreach ($imageFiles as $item => $image) {
            $data = $image->getAttribute('src');
            if (strpos($data, 'data:image') === 0) {
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $imageData = base64_decode($data);

                if ($imageData === false) {
                    Log::channel('daily')->error('Failed to decode base64 image data');
                    continue;
                }

                $imageName = "/uploads/" . time() . $item . '.png';
                $path = public_path() . $imageName;

                if (file_put_contents($path, $imageData) === false) {
                    Log::channel('daily')->error('Failed to save image file to path: ' . $path);
                    continue;
                }

                $image->removeAttribute('src');
                $image->setAttribute('src', $imageName);
            } else {
                Log::channel('daily')->error('Image src attribute is not base64 encoded: ' . $data);
            }
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
