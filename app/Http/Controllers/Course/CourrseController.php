<?php

namespace App\Http\Controllers\Course;

use App\Helpers\Common;
use Illuminate\Http\Request;
use App\Models\system\Courses;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Level\LevelDaoImpl;

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
            $fileUploadResult = Common::handleFileUpload($request, 'c_logo', '/uploads/schools/');

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


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
