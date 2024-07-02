<?php

namespace App\Http\Controllers\Course;

interface CourseDao
{
    public function getCourse();
    public function getCourseById($id);
    public function createCourse($data);
    public function updateCourseById($id, $data);
    public function deleteCourseById($id);


    /// modules

    public function getModule();
    public function ajaxModuleByCourseId($course_id);
    public function valiateModule($data);

    public function getModuleById($id);
    public function createModule($data);
    public function updateModuleById($id, $data);
    public function deleteModuleById($id);


    // lessons

    public function getLesson();
    public function getLessonById($id);
    public function createLesson($data);
    public function updateLessonById($id, $data);
    public function deleteLessonById($id);


    // faqs
    public function getFaq();
    public function getFaqById($id);
    public function createFaq($data);
    public function updateFaqById($id, $data);
    public function deleteFaqById($id);
}
