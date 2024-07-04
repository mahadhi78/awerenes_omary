<?php

namespace App\Http\Controllers\Course;

use App\Helpers\Common;
use App\Models\system\Faq;
use App\Constants\Constants;
use Illuminate\Http\Request;
use App\Models\system\Courses;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Level\LevelDaoImpl;
use App\Http\Controllers\Course\CourseDaoImpl;

class FaqsController extends Controller
{
    protected $course, $level;
    public function __construct(CourseDaoImpl $course, LevelDaoImpl $level)
    {
        $this->course = $course;
        $this->level = $level;
        $this->middleware(['auth', 'prevent-back-history']);
    }

    public function index()
    {
        $d['faqs'] = $this->course->getFaq();
        return view("pages.C_M_L_manage.faq.index", $d);
    }
    public function create()
    {
        // $d['faqs'] = $this->course->getFaq();
        $d['faqs'] = null;
        return view("pages.C_M_L_manage.faq.create",$d);
    }
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), Faq::$rules);

            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->errors()];
            }

            $schoolExists = Faq::where("name", "=", $data['name'])->first();
            if ($schoolExists) {
                $response = 'Faq: ' . $data['name'] . ' already exists';
                return ['success' => 'failure', 'response' => $response];
            }
            $file = $request->file('file');
            $path = 'uploads/faqs/';
            $filename = 'faqs_' . time() . '.json';
            $file->move(public_path($path), $filename);
            $data['description'] = $path . $filename;

            try {
                $school = $this->course->createFaq($data);
                if ($school) {
                    $response = 'Faq saved successfully';
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
        $upload = $this->course->getFaqById($id);
        $filePath = public_path($upload->description);

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found.'], 404);
        }

        $contents = json_decode(file_get_contents($filePath), true);

        return response()->json($contents);
    }

    public function edit($id)
    {
        $decodedId = Common::decodeHash($id);
        $d['faqs'] = $this->course->getFaqById($decodedId);
        $filePath = public_path($d['faqs']->description);
    
        if (file_exists($filePath)) {
            $content = json_decode(file_get_contents($filePath), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $d['faqs'] = $content;
            }
        }
        $d['faqs']['id'] = $decodedId;
        return view("pages.C_M_L_manage.faq.create", $d);
    }
    

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), Faq::$rules);

            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->errors()];
            }
            $file = $request->file('file');
            $path = 'uploads/faqs/';
            $filename = 'faqs_' . time() . '.json';
            $file->move(public_path($path), $filename);
            $data['description'] = $path . $filename;
            
            try {
                $school = $this->course->updateFaqById($data['id'], $data);
                if ($school) {
                    $response = 'Faq Updated successfully';
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
        $class = $this->course->deleteFaqById($request['id']);
        try {
            $response = 'Faq Deleted Successfully';
            Log::channel('daily')->info($response . ' ' . $class);
            return ['success' => true, 'response' => $response];
        } catch (\Exception $error) {
            $response = 'Operation Failed,Please Contact System Administrator ' . $error;
            Log::channel('daily')->error($response . ' ' . $error->getMessage());
            return ['success' => 'failure', 'response' => $response];
        }
    }
}
