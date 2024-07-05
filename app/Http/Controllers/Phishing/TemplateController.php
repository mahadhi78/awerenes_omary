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
            $fullPath = 'uploads/template';
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

    public function preview($id)
    {
        $upload = $this->phishing->getTemplateById($id);
        $filePath = public_path($upload->info);

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found.'], 404);
        }

        $contents = json_decode(file_get_contents($filePath), true);

        return response()->json($contents);
    }

    public function destroy(Request $request)
    {
        $class = $this->phishing->deleteTemplateById($request['id']);
        try {
            $response = 'Template Deleted Successfully';
            Log::channel('daily')->info($response . ' ' . $class);
            return ['success' => true, 'response' => $response];
        } catch (\Exception $error) {
            $response = 'Operation Failed,Please Contact System Administrator ' . $error;
            Log::channel('daily')->error($response . ' ' . $error->getMessage());
            return ['success' => 'failure', 'response' => $response];
        }
    }

}
