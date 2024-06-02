<?php
namespace App\Http\Controllers\Home;

use App\Constants\Constants;
use App\Http\Controllers\student\Model\Student;
use App\Models\User;

class HomeDaoImpl implements HomeDao
{
     public function countStaff()
     {
          return User::where('status', Constants::STATUS_ACTIVE)->count();
     }
     public function countStudents()
     {
          // return Student::count();
     }

}