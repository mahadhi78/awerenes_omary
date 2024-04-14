<?php

namespace App\Http\Controllers\Course;

use App\Helpers\Common;
use App\Constants\Constants;
use Illuminate\Http\Request;
use App\Models\system\Courses;
use App\Models\system\Modules;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Level\LevelDaoImpl;

class ModuleController extends Controller
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
        $d['module'] = $this->course->getModule();
        $d['levels'] = $this->level->getAlevelByIdAndName();
        return view("pages.C_M_L_manage.module.index", $d);
        // return $d;
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), Modules::$rules);

            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->errors()];
            }

            $schoolExists = $this->course->valiateModule("m_name", $data['m_name'])->first();
            if ($schoolExists) {
                $response = 'Module: ' . $data['m_name'] . ' already exists';
                return ['success' => 'failure', 'response' => $response];
            }
            try {
                $school = $this->course->createModule($data);
                if ($school) {
                    $response = 'Module saved successfully';
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

    public function modulePreview($id)
    {
        if (Auth::user()->userType == Constants::LEARNER) {
            return redirect()->route('learning.home');

        }
        $id = Common::decodeHash($id);
        $d['modules'] = $this->course->getLessonByModuleId($id);
        // 

        return view("pages.C_M_L_manage.module.preview.index", $d);
        //
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
