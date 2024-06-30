<?php

namespace App\Models\system;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "templates";
    protected $fillable = [
        'temp_name',
        'info',
    ];

    public static $rules = [
        "temp_name" => "required|max:100",
        "info" => "required",
        'file' => 'required|file|mimes:json|max:10240', // 5MB max size

    ];
}
