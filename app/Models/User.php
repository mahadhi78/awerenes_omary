<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
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
        'userType',
        'photo_path',
        'username',
        'is_deleted',
        'email_token'
    ];

    public static $rules = [
        "firstname" => "required |min:3|max:30",
        "lastname" => "required |min:3|max:30",
        "phone_number" => "required",
        'email' => 'required|unique:users,email|email',
        'password' => [
            'required',
            'string',
            'min:8',             // must be at least 10 characters in length
            'regex:/[a-z]/',      // must contain at least one lowercase letter
            'regex:/[A-Z]/',      // must contain at least one uppercase letter
            'regex:/[0-9]/',      // must contain at least one digit
            'regex:/[@$!%*#?&]/', // must contain a special character
        ]
    ];

	public static $update_rules = [
		'firstname' => 'required',
		'middlename' => 'required',
		'lastname' => 'required',
		'phone_number' => 'required',
		'email' => ['required', 'string', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
	];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
