<?php

namespace App\Models\system;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewData extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "news";
    protected $fillable = [
        'new_name',
        'description',
    ];

    public static $rules = [
        "new_name" => "required|max:50|min:5",
        "description" => "required",
        'file' => 'required|file|mimes:json|max:10240', // 5MB max size

    ];
}
