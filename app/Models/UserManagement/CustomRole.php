<?php

namespace App\Models\UserManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomRole extends Model
{

	use HasFactory;
	protected $table   =  "roles";
	protected $guarded =  ['id'];

	public static $rules = [
		'name' => 'required|unique:roles,name',
		'status' => 'required',
	];
}
