<?php

namespace App\Http\Controllers\Phishing;

use DOMDocument;
use App\Helpers\Common;
use App\Constants\Constants;
use Illuminate\Http\Request;
use App\Models\system\Lesson;
use App\Models\system\Courses;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Level\LevelDaoImpl;
use App\Models\system\Template;

class TemplateController extends Controller
{
    protected $phishing;
    public function __construct(PhishingDaoImpl $phishing)
    {
        $this->phishing = $phishing;
        $this->middleware(['auth', 'prevent-back-history']);
    }

    public function index()
    {
        if (Auth::user()->userType == Constants::LEARNER) {
            return redirect()->route('learning.home');
        }
        $d['comaign'] = $this->phishing->getCompaign();

        return view("pages.phishing.index", $d);
    }


    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), Template::$rules);

            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->errors()];
            }
            $schoolExists = Template::where("temp_name", "=", $data['temp_name'])->first();
            if ($schoolExists) {
                $response = 'Template: ' . $data['temp_name'] . ' already exists';
                return ['success' => 'failure', 'response' => $response];
            }
            $file = $request->file('file');
            $filename = 'template_' . time() . '.json';
            $fullPath= 'uploads/template';
            $file->move(public_path($fullPath), $filename);
            $data['info'] = $fullPath . '/' . $filename;
    
            try {
                $school = $this->phishing->createTemplate($data);
                if ($school) {
                    $response = 'Template Saved successfully';
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

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = public_path('uploads');

            if (!file_exists($filePath)) {
                mkdir($filePath, 0755, true);
            }
            $file->move($filePath, $filename);
            $url = asset('uploads/' . $filename);

            return response()->json([
                'uploaded' => true,
                'url' => $url,
            ]);
        }
        return response()->json(['uploaded' => false, 'error' => ['message' => 'No file uploaded']], 400);
    }

}
