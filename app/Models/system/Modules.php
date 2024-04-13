<?php

namespace App\Models\system;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modules extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "modules";

    protected $fillable = [
        'm_name',
        'course_id',
        'level_id',

    ];

    public static $rules = [
        "m_name" => "required |min:3|max:150",
        "course_id" => "required|exists:courses,id",
        "level_id" => "required|exists:levels,id",
    ];
}
