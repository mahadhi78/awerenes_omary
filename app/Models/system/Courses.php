<?php

namespace App\Models\system;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courses extends Model
{
    use HasFactory,SoftDeletes;

    
    protected $table = "courses";
    protected $fillable = [
        'c_name',
        'level_id',
        'c_logo',
        'total_modules',

    ];

    public static $rules = [
        "c_name" => "required |min:3|max:50",
        "level_id" => "required|exists:levels,id",
        "c_logo" => "required |min:3|max:50",
    ];
}
