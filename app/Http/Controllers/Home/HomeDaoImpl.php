<?php

namespace App\Http\Controllers\Home;

use App\Constants\Constants;
use App\Http\Controllers\student\Model\Student;
use App\Models\system\Courses;
use App\Models\system\Template;
use App\Models\User;

class HomeDaoImpl implements HomeDao
{
     public function countStaff()
     {
          return User::where([['status', Constants::STATUS_ACTIVE], ['userType', '!=', Constants::LEARNER]])->count();
     }
     public function countStudents()
     {
          return User::where([['status', Constants::STATUS_ACTIVE], ['userType', '=', Constants::LEARNER]])->count();
     }

     public function countCourse()
     {
          return Courses::count();
     }

     public function templateCount()
     {
          return Template::count();
     }
}
