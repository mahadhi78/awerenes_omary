<?php

namespace App\Models\UserManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
     
      use HasFactory;
     protected $table   =  "permissions";
     protected $guarded =  ['id'];
     
	  public static $rules = [
	   'name' => 'required|unique:roles,name',
	   "module" => "required |min:3|max:50",
	   "action" => "required |min:3|max:50",
	   "description" => "required |min:3|max:50"
	  ];
}
