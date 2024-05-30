<?php

namespace App\Models\system;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "lessons";

    protected $fillable = [
        'lesson_name',
        'module_id',
        'level_id',
        'course_id',
        'description'

    ];

    public static $rules = [
        "lesson_name" => "required |min:3|max:150",
        "module_id" => "required|exists:courses,id",
        "level_id" => "required|exists:levels,id",
        "course_id" => "required|exists:courses,id",
        "description" => "required",
    ];
}
