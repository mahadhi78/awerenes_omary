<?php

namespace App\Models\UserManagement;

use App\Constants\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomUser extends Model
{

	use HasFactory;
	protected $table   =  "users";
	protected $guarded =  ['id'];

	protected $fillable = [
		'firstname',
		'middlename',
		'lastname',
		'dob',
		'phone_number',
		'email',
		'password',
		'status',
		'gender',
		'admision_date',
		'activation_status',
		'is_approved',
		'school_id',
		'photo_path'
	];
	public static $rules = [
		'firstname' => 'required',
		'middlename' => 'required',
		'lastname' => 'required',
		'phone_number' => 'required',
		'email' => ['required', 'string', 'email', 'unique:users', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
	];

	public static $learner_rules = [
		'firstname' => 'required',
		'middlename' => 'required',
		'lastname' => 'required',
		'password' => 'required',
		'username' => 'required|unique:users|min:8|max:50',
		'email' => ['required', 'string', 'email', 'unique:users', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
	];
	public static $update_rules = [
		'firstname' => 'required',
		'middlename' => 'required',
		'lastname' => 'required',
		'phone_number' => 'required',
		'roles' => 'required',
		'email' => ['required', 'string', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
	];
}
