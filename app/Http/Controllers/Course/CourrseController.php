<?php

namespace App\Http\Controllers\Course;

use App\Helpers\Common;
use App\Constants\Constants;
use Illuminate\Http\Request;
use App\Models\system\Courses;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Level\LevelDaoImpl;
use App\Http\Controllers\Course\CourseDaoImpl;

class CourrseController extends Controller
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
        $d['course'] = $this->course->getCourse();
        $d['levels'] = $this->level->getAlevelByIdAndName();
        if (Auth::user()->userType == Constants::LEARNER) {
            return view('pages.Learn.course.index', $d);
        }        
        return view("pages.C_M_L_manage.course.index", $d);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), Courses::$rules);

            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->errors()];
            }

            $schoolExists = Courses::where("c_name", "=", $data['c_name'])->first();
            if ($schoolExists) {
                $response = 'Course: ' . $data['c_name'] . ' already exists';
                return ['success' => 'failure', 'response' => $response];
            }
            $fileUploadResult = Common::handleFileUpload($request, 'c_logo', '/uploads/course/');

            if ($fileUploadResult['success']) {
                $data['c_logo'] = $fileUploadResult['response'];
                try {
                    $school = $this->course->createCourse($data);
                    if ($school) {
                        $response = 'Course saved successfully';
                        Log::channel('daily')->info($response . ': ' . $school);
                        return ['success' => true, 'response' => $response];
                    }
                } catch (\Exception $error) {
                    $response = 'Operation failed, please contact the system administrator: ' . $error->getMessage();
                    Log::channel('daily')->error($response);
                    return ['success' => 'failure', 'response' => $response];
                }
            }
            else{
                return $fileUploadResult;
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
        return response()->json($this->course->getCourseById($id));
    }


    public function update(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), Courses::$rules);

            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->errors()];
            }
            $school = $this->course->getCourseById($data['id']);

            $oldLogo = $school->logo;
            $schoolExists = Courses::where("c_name", "=", $data['c_name'])->first();
            if ($schoolExists) {
                $response = 'Course: ' . $data['c_name'] . ' already exists';
                return ['success' => 'failure', 'response' => $response];
            }
            $fileUploadResult = Common::handleFileUpload($request, 'c_logo', '/uploads/course/');

            if ($fileUploadResult['success']) {
                $data['c_logo'] = $fileUploadResult['response'];
                try {
                    $school = $this->course->updateCourseById($data['id'],$data);
                    if ($school) {
                        $response = 'Course Updated successfully';
                        Log::channel('daily')->info($response . ': ' . $school);
                        return ['success' => true, 'response' => $response];
                    }
                } catch (\Exception $error) {
                    $response = 'Operation failed, please contact the system administrator: ' . $error->getMessage();
                    Log::channel('daily')->error($response);
                    return ['success' => 'failure', 'response' => $response];
                }
            }
            else{
                return $fileUploadResult;
            }
        }
    }


    public function destroy(Request $request)
    {
        $class = $this->course->deleteCourseById($request['id']);
        try {
            $response = 'Course Deleted Successfully';
            Log::channel('daily')->info($response . ' ' . $class);
            return ['success' => true, 'response' => $response];
        } catch (\Exception $error) {
            $response = 'Operation Failed,Please Contact System Administrator ' . $error;
            Log::channel('daily')->error($response . ' ' . $error->getMessage());
            return ['success' => 'failure', 'response' => $response];
        }
    }
}
