<?php

namespace App\Http\Controllers\Course;

use App\Constants\Constants;
use App\Models\system\Courses;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Course\CourseDao;
use App\Models\system\Lesson;
use App\Models\system\Modules;

class CourseDaoImpl implements CourseDao
{
    public function getCourse()
    {
        $data = Courses::join('levels', 'levels.id', '=', 'courses.level_id')
            ->select('courses.*', 'levels.lv_name as level_name')
            ->where(function ($query) {
                // Check if the user is a super administrator
                if (Auth::user()) {
                    if (Auth::user()->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR)) {
                        // If so, retrieve all schools
                        $query->withTrashed()->orderBy('id', 'asc');
                    } else {
                        // If not, retrieve only non-deleted schools
                        $query->orderBy('id', 'asc');
                    }
                } else {
                    $query->orderBy('id', 'asc');
                }
            })
            ->get();

        return $data;
    }
    public function ajaxCourseByLevelId($level_id)
    {
        return Courses::where('level_id', $level_id)->select('c_name', 'id')->get();
    }
    public function getCourseById($id)
    {
        return Courses::findOrFail($id);
    }
    public function createCourse($data)
    {
        return Courses::create($data);
    }
    public function updateCourseById($id, $data)
    {
        return Courses::findOrFail($id)->update($data);
    }
    public function deleteCourseById($id)
    {
        return Courses::findOrFail($id)->delete();
    }


    /// modules
    public function getModule()
    {
        $data = Modules::join('courses', 'courses.id', '=', 'modules.course_id')
            ->join('levels', 'levels.id', '=', 'modules.level_id')
            ->select('modules.*', 'courses.c_name as course_name', 'levels.lv_name')
            ->where(function ($query) {
                if (Auth::user()->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR)) {
                    $query->withTrashed()->orderBy('id', 'asc');
                } else {
                    $query->orderBy('id', 'asc');
                }
            })
            ->get();

        return $data;
    }
    public function ajaxModuleByCourseId($course_id)
    {
        return Modules::where('course_id', $course_id)->select('m_name', 'id')->get();
    }

    public function valiateModule($data)
    {
        return Modules::where($data);
    }
    public function getModuleById($id)
    {
        return Modules::findOrFail($id);
    }
    public function getModuleByCourseId($course_id)
    {
        return Modules::where('course_id', $course_id)->get();
    }
    public function createModule($data)
    {
        return Modules::create($data);
    }
    public function updateModuleById($id, $data)
    {
        return Modules::findOrFail($id)->update($data);
    }
    public function deleteModuleById($id)
    {
        return Modules::findOrFail($id)->delete();
    }



    // lessons

    public function getLesson()
    {
        return Lesson::join('courses', 'courses.id', '=', 'modules.course_id')
            ->join('levels', 'levels.id', '=', 'modules.level_id')
            // ->select('modules.*', 'courses.c_name as course_name', 'levels.lv_name')
            ->where(function ($query) {
                if (Auth::user()->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR)) {
                    $query->withTrashed()->orderBy('id', 'asc');
                } else {
                    $query->orderBy('id', 'asc');
                }
            })
            ->get();
    }
    public function getLessonById($id)
    {
        return Modules::findOrFail($id);
    }

    public function getLessonByModuleId($module_id)
    {
        return Lesson::join('modules', 'modules.id', '=', 'lessons.module_id')
            ->where('module_id', $module_id)->get();
    }
    public function createLesson($data)
    {
        return Lesson::create($data);
    }
    public function updateLessonById($id, $data)
    {
        return Lesson::findOrFail($id)->update($data);
    }
    public function deleteLessonById($id)
    {
        return Lesson::findOrFail($id)->delete();
    }
}
