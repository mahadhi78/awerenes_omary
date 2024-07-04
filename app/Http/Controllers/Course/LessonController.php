<?php

namespace App\Http\Controllers\Course;

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

class LessonController extends Controller
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
        if (Auth::user()->userType == Constants::LEARNER) {
            return redirect()->route('learning.home');
        }
        $d['lesson'] = $this->course->getLesson();

        return view("pages.C_M_L_manage.lessons.index", $d);
    }
    public function create()
    {
        if (Auth::user()->userType == Constants::LEARNER) {
            return redirect()->route('learning.home');
        }
        $d['course'] = $this->course->getCourse();
        $d['levels'] = $this->level->getAlevelByIdAndName();
        $d['lesson'] = null;
        return view("pages.C_M_L_manage.lessons.create", $d);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), Lesson::$rules);

            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->errors()];
            }

            $schoolExists = Lesson::where("lesson_name", "=", $data['lesson_name'])->first();
            if ($schoolExists) {
                $response = 'Lesson: ' . $data['lesson_name'] . ' already exists';
                return ['success' => 'failure', 'response' => $response];
            }

            $file = $request->file('file');
            $filename = 'lesson_' . time() . '.json';
            $file->move(public_path('uploads/lessons'), $filename);
            $data['description'] = 'uploads/lessons/' . $filename;
            try {
                $school = $this->course->createLesson($data);
                if ($school) {
                    $response = 'Lesson saved successfully';
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
        $d['course'] = $this->course->getCourse();
        $d['levels'] = $this->level->getAlevelByIdAndName();
        $d['lesson'] = $this->course->getLessonById(Common::decodeHash($id));
        $d['selected_level_id'] = $d['lesson']->level_id; // Extract the level_id
        $d['lesson_data'] = $d['lesson'];
        $filePath = public_path( $d['lesson_data']->description);
        if (file_exists($filePath)) {
            $content = json_decode(file_get_contents($filePath), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $d['lesson_data'] = $content;
            } else {
                // Handle JSON decode error
                // Optionally, you can log the error or handle it in another way
                $d['lesson_data'] = ['error' => 'Invalid JSON format'];
            }
        } else {
            // Handle file not found error
            $d['lesson_data'] = ['error' => 'File not found'];
        }
    
        return view("pages.C_M_L_manage.lessons.create", $d);
    }
    
    public function update(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), Lesson::$rules);

            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->errors()];
            }

            $schoolExists = Lesson::where("lesson_name", "=", $data['lesson_name'])->first();
            if ($schoolExists) {
                $response = 'Lesson: ' . $data['lesson_name'] . ' already exists';
                return ['success' => 'failure', 'response' => $response];
            }
        // dd($request->all());

            $file = $request->file('file');
            $filename = 'lesson_' . time() . '.json';
            $file->move(public_path('uploads/lessons'), $filename);
            $data['description'] = 'uploads/lessons/' . $filename;
            try {
                $school = $this->course->updateLessonById($data['id'], $data);
                $response = 'Lesson Updated successfully';
                Log::channel('daily')->info($response . ': ' . $school);
                return ['success' => true, 'response' => $response];
            } catch (\Exception $error) {
                $response = 'Operation failed, please contact the system administrator: ' . $error->getMessage();
                Log::channel('daily')->error($response);
                return ['success' => 'failure', 'response' => $response];
            }
        }
    }


    public function destroy(Request $request)
    {
        $class = $this->course->deleteLessonById($request['id']);
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
